<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order as OrderResouce;
use Session;
use Stripe;
use Auth;

class OrderController extends Controller
{
    protected $statusSuccess = 200;
    protected $statusNotFound = 404;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->paginate(3);

        return OrderResouce::collection($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment_method = $request->payment_method;
        switch ($payment_method) {
            case 'vnpay':
                dd('VNPAY');
                break;
            case 'stripe':
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                /**
                 * Create customer save bby API(s)
                 */
                $customer = Stripe\Customer::create([
                    "email" => $request->email,
                    "source" => $request->stripeToken
                ]);

                $charge = Stripe\Charge::create([
                    'amount' => ($request->amount) * 100,
                    'currency' => 'usd',
                    'description' => $request->content,
                    'customer' => $customer->id,
                ]);
                if ($charge['status'] == 'succeeded') {

                    /**
                     * Save to Database
                     */
                    $order = new Order();
                    $order->code = $charge['id'];
                    $order->user_id = Auth::user()->id;
                    $order->amount = $charge['amount'];
                    $order->currency = $charge['currency'];
                    $order->content = $charge['description'];
                    $order->status = $charge['status'];
                    $order->ip_address = request()->ip();

                    $order->save();

                    return response()->json([
                        'status' => $this->statusSuccess,
                        'data' => 'Your payment was successfully'
                    ], $this->statusSuccess);

                } else {
                    return response()->json([
                        'status' => $this->statusNotFound,
                        'data' => 'Please check your information again and make sure it\'s correct!.'
                    ], $this->statusNotFound);
                }
                break;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $order = Order::with('user')->findById($id)->first();

        if ( empty($order) ) {
            return response()->json([
                'status' => $this->statusNotFound,
                'data' => 'Not found'
            ], $this->statusNotFound);
        }

        return response()->json([
            'status' => $this->statusSuccess,
            'data' => $order
        ], $this->statusSuccess);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

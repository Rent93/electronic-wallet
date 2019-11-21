<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Stripe;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::sort('desc')->paginate(20);

        return view('front-end.order.index', compact(['orders']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('front-end.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws Stripe\Exception\ApiErrorException
     */
    public function store(Request $request)
    {

//        dd($request->all());

        $payment_method = $request->payment_method;

        switch ($payment_method) {
            case 'vnpay':
                dd('vnpay');
            case 'baokim':
                dd('baokim');
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
                    $order->ip_address = $_SERVER['REMOTE_ADDR'];

                    $order->save();


                    Session::flash('success', 'Your payment successful!');
                } else {
                    Session::flash('error', 'Please check your information again and make sure it\'s correct!.');
                }
                break;

        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

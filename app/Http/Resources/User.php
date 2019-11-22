<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'type'          => 'user',
            'id'            => $this->id,
            'data' => [
                'username'      => $this->username,
                'name'          => $this->name,
                'email'         => $this->email,
                'created_at'    => $this->created_at,
                'updated_at'    => $this->updated_at,
            ],
        ];
    }

//    public function with($request) {
//        return [
//            'version' => '1.0.0',
//            'author' => 'Rent'
//        ];
//    }
}

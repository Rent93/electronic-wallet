<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function scopeSort($query, $type) {
        return $query->orderBy('created_at', $type);
    }
}

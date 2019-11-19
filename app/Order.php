<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function scopeSort($query, $type) {
        return $query->orderBy('created_at', $type);
    }
}

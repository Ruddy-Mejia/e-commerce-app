<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'items', 'total_price'];

    public function getItemsAttribute($value)
    {
        return json_decode($value, true);
    }
}

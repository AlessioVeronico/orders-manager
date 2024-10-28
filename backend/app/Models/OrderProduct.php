<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;

    protected $table = 'orders_products';

    public $incrementing = true;
    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected $fillable = [
        'order_id',
        'product_id'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];
}

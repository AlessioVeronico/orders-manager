<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    public $incrementing = true;
    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'price'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, OrderProduct::class, 'product_id', 'order_id');
    }
}

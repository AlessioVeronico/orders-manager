<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    public $incrementing = true;
    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'description',
        'date'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class, 'product_id', 'order_id');
    }
}

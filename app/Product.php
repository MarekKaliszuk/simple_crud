<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductOption;

class Product extends Model
{
    public function productOption(){
        return $this->hasMany('App\ProductOption', 'product_id');
    }

    public static function getPrice($product_id){
        return productOption::where('option_name', '=', 'price')
            ->where('product_id', '=', $product_id)
            ->first()->value;
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($product) {
            $product->productOption()->delete();
        });
    }
}

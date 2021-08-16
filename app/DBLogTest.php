<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;

class DBLogTest extends  Moloquent 
{
	protected $collection =  'd_b_log_tests';
    // protected $appends = [
    //     'message',
    // ];   
    // public function getProductAttribute()
    // {
    //    return Product::where("id", $this->product_id)->select("id", "sku", "name", "name_ar")->first();
    // }
}

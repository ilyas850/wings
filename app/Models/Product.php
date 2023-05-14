<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'product_code', 'product_name', 'price', 'currency', 'discount', 'dimension', 'unit'
    ];
}

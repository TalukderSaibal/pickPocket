<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAdvanceModel extends Model
{
    protected $table = 'product_advance';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'product_type', 
        'is_active', 
        'is_point',
        'is_feature',
        'unit_id', 
        'brand_id', 
        'product_weight', 
        'product_price', 
        'discount_price', 
        'min_order', 
        'max_order', 
        'sku'
    ];
}
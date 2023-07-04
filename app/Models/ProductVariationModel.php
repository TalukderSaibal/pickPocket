<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductVariationModel extends Model
{
    protected $table = 'product_variation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['language_id', 'variation_name', 'attribute_id'];
}
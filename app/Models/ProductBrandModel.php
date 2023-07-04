<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductBrandModel extends Model
{
    protected $table = 'product_brand';
    protected $primaryKey = 'id';
    protected $allowedFields = ['language_id', 'brand_name', 'brand_slug', 'brand_media'];
}
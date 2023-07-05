<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductSeoModel extends Model
{
    protected $table = 'product_seo';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'seo_meta_tag',
        'seo_meta_description'
    ];
}
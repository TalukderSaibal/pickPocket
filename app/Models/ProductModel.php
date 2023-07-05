<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product_general';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_media', 'category_id', 'language_id', 'product_name', 'product_description', 'video_code'];
}
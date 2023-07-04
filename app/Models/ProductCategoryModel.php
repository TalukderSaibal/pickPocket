<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['language_id', 'category_name', 'category_description', 'parent_category', 'category_slug', 'category_media', 'category_icon'];
}
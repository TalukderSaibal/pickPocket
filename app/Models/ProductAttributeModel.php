<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAttributeModel extends Model
{
    protected $table         = 'product_attribute';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['language_id', 'attribute_name'];
}
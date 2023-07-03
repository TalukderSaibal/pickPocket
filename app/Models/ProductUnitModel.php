<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductUnitModel extends Model
{
    protected $table = 'product_unit';
    protected $primaryKey = 'unit_id';
    protected $allowedFields = ['language_id', 'unit_name'];

    //Data Insert Methods
    public function insertData($data)
    {
        $res = $this->insert($data);

        if($res){
            return true;
        }else{
            return false;
        }
    }

    //Data Update Methods
    public function updateData($id, $data){
        $res = $this->update($id, $data);

        if($res){
            return true;
        }else{
            return false;
        }
    }
}
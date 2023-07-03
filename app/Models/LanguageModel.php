<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['language_name', 'language_code'];

    public function inserData($data){
        $data = $this->insert($data);

        if($data){
            return true;
        }else{
            return false;
        }
    }
}
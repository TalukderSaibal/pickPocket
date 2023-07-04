<?php

namespace App\Controllers;

use App\Models\ProductAttributeModel;
use App\Models\LanguageModel;

class ProductAttributeController extends BaseController
{
    protected $productAttributeModel,$db;

    public function __construct(){
        $this->productAttributeModel = new ProductAttributeModel();
        $this->db                    = \Config\Database::connect();
    }

    //Product attribute List
    public function index(){
        $query = 'SELECT id,language_name FROM  languages';
        $res = $this->db->query($query);

        $data = [
            'languages' => $res->getResult(),
            'attributes'     => $this->productAttributeModel->paginate(6),
            'pager'     => $this->productAttributeModel->pager,
        ];
        return view('catelog/productAttribute', $data);
    }

    //Product attribute create
    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'attributeName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'attributeName' => [
                    'status' => 'error',
                    'message' => 'Attribute name is required',
                ]
            ];
            return json_encode($response);
        }

        $data = [
            'language_id' => $this->request->getPost('languageSelect'),
            'attribute_name'   => $this->request->getPost('attributeName')
        ];

        $res = $this->productAttributeModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Unit created successfully',
            ];

            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Unit creation failed',
            ];

            return json_encode($response);
        }
    }

    //Product Attribute Method
    public function attributeEdit($id){
        $query = 'SELECT product_attribute.id AS attributeId, product_attribute.language_id AS languageId,product_attribute.attribute_name AS attributeName, languages.* FROM product_attribute
        LEFT JOIN languages ON product_attribute.language_id = languages.id WHERE product_attribute.id = ' . $id;
        $data = $this->db->query($query);
        $res = $data->getResult();

        $languageModel = new LanguageModel();

        $languges = $languageModel->findAll();

        return view('catelog/productAttributeEdit', ['res' => $res, 'languges' => $languges]);
    }

    //Attribute Update Method
    public function update(){
        $validation = \Config\Services::validation();

        $rules = [
            'attributeName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'attributeName' => [
                    'status' => 'error',
                    'message' => 'Attribute name is required',
                ],
            ];

            return json_encode($response);
        }

        $attributeId    = $this->request->getPost('attributeId');
        $languageSelect = $this->request->getPost('languageSelect');
        $attributeName  = $this->request->getPost('attributeName');

        $data = [
            'language_id' => $languageSelect,
            'attribute_name' => $attributeName
        ];

        $res = $this->productAttributeModel->update($attributeId, $data);

        if($res){
            $response =[
                'status' => 'success',
                'message' => 'Attribute was successfully updated',
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Attribute could not be updated',
            ];
            return json_encode($response);
        }
    }

    //Delete a product attribute
    public function delete(){
        $atrributeId = $this->request->getPost('id');

        $res = $this->productAttributeModel->delete($atrributeId);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Attribute was successfully deleted',
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'success',
                'message' => 'Attribute was delete failed',
            ];
            return json_encode($response);
        }
    }
    
}
<?php

namespace App\Controllers;

use App\Models\LanguageModel;
use App\Models\ProductVariationModel;
use App\Models\ProductAttributeModel;

class ProductVariationController extends BaseController
{
    protected $productVariationModel,$db;

    public function __construct(){
        $this->productVariationModel = new ProductVariationModel();
        $this->db                    = \Config\Database::connect();
    }

    public function index(){
        $query = 'SELECT id,language_name FROM  languages';
        $res = $this->db->query($query);

        $query1 = 'SELECT product_variation.id AS variationId,product_variation.language_id AS languageId, product_variation.variation_name AS variationName,product_variation.attribute_id AS attributeId,product_attribute.*  FROM product_variation
        LEFT JOIN product_attribute ON product_variation.attribute_id = product_attribute.id';

        // // Enable pagination
        // $pageNumber = $this->request->getVar('page') ?? 1; // Get the current page number from the request
        // $perPage = 10; // Number of records per page
        // $totalRecords = $this->db->query($query1)->getNumRows(); // Get the total number of records
        // $totalPages = ceil($totalRecords / $perPage); // Calculate the total number of pages

        // $offset = ($pageNumber - 1) * $perPage;
        // $query1 .= " LIMIT $perPage OFFSET $offset";

        $attributeModel = new ProductAttributeModel();

        $data = [
            'languages' => $res->getResult(),
            'attributes' => $attributeModel->findAll(),
            'variations' => $this->db->query($query1)->getResult(),
            // 'pager' => $this->db->pager->makeLinks($pageNumber, $perPage, $totalRecords, 'catelog/productVariation')
        ];
        return view('catelog/productVariation', $data);
    }

    //Variation create mthod
    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'variationName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'variationName' => [
                    'status' => 'error',
                    'message' => 'Attribute name is required',
                ]
            ];
            return json_encode($response);
        }

        $data = [
            'language_id'    => $this->request->getPost('languageSelect'),
            'variation_name' => $this->request->getPost('variationName'),
            'attribute_id'   => $this->request->getPost('attributeId'),
        ];

        $res = $this->productVariationModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Variation created successfully',
            ];

            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Variation creation failed',
            ];

            return json_encode($response);
        }
    }

    //Variation form view method
    public function variationEdit($id){
        $query = 'SELECT product_variation.id AS variationId, product_variation.language_id AS languageId,product_variation.variation_name AS variationName, languages.* FROM product_variation
        LEFT JOIN languages ON product_variation.language_id = languages.id WHERE product_variation.id = ' . $id;
        $data = $this->db->query($query);
        $res = $data->getResult();

        $languageModel = new LanguageModel();

        $languges = $languageModel->findAll();

        $attributeModel = new ProductAttributeModel();
        $attributes = $attributeModel->findAll();

        return view('catelog/variationEdit', ['res' => $res, 'languges' => $languges, 'attributes' => $attributes]);
    }

    //variation update view method
    public function update(){
        $validation = \Config\Services::validation();

        $rules = [
            'variationName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'variationName' => [
                    'status' => 'error',
                    'message' => 'Variation name is required',
                ],
            ];

            return json_encode($response);
        }

        $variationId    = $this->request->getPost('variationId');
        $languageSelect = $this->request->getPost('languageSelect');
        $variationName  = $this->request->getPost('variationName');
        $attributeId  = $this->request->getPost('attributeId');

        $data = [
            'language_id' => $languageSelect,
            'variation_name' => $variationName,
            'attribute_id' => $attributeId,
        ];

        $res = $this->productVariationModel->update($variationId, $data);

        if($res){
            $response =[
                'status' => 'success',
                'message' => 'Variation was successfully updated',
            ];
            return json_encode($response);
        }else{
            $response =[
                'status' => 'failed',
                'message' => 'Variation was updated failed',
            ];
            return json_encode($response);
        }
    }

    //Product Variation delete method
    public function delete(){
        $variationId = $this->request->getPost('id');

        $res = $this->productVariationModel->delete($variationId);

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
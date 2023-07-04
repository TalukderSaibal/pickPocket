<?php

namespace App\Controllers;

use App\Models\LanguageModel;
use App\Models\ProductBrandModel;

class ProductBrandController extends BaseController
{
    protected $productBrandModel,$db;

    public function __construct(){
        $this->productBrandModel = new ProductBrandModel();
        $this->db                = \Config\Database::connect();
    }

    public function index(){
        $query = 'SELECT id,language_name FROM  languages';
        $res = $this->db->query($query);

        $data = [
            'languages'  => $res->getResult(),
            'brands' => $this->productBrandModel->paginate(6),
            'pager'      => $this->productBrandModel->pager,
        ];
        return view('catelog/productBrand', $data);
    }

    // Brand Create Method
    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'brandName' => 'required',
            'brandImage' => 'required',
        ];

        // if(!$this->validate($rules)){
        //     $response = [
        //         'brandName' => [
        //             'status' => 'error',
        //             'message' => 'Brand name is required'
        //         ],
        //         'brandImage' => [
        //             'status' => 'error',
        //             'message' => 'Brand image is required'
        //         ]
        //     ];
        //     return json_encode($response);
        // }

        $languageSelect = $this->request->getPost('languageSelect');
        $brandName      = (string) $this->request->getPost('brandName');
        $brandImage     = $this->request->getFile('brandImage')->getClientName();

        $flag = $this->request->getFile('brandImage');
        $flag->move(ROOTPATH . 'public/BrandImage');

        $data = [
            'language_id' => $languageSelect,
            'brand_name'  => $brandName,
            'brand_slug'  => url_title($brandName, '-', true),
            'brand_media' => $brandImage,
        ];

        $res = $this->productBrandModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Product brand created successfully'
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Product brand created successfully'
            ];
            return json_encode($response);
        }
    }

    //Brand edit form view
    public function brandEdit($id){
        $query = 'SELECT product_brand.id AS productBrandId, product_brand.language_id AS languageId,product_brand.brand_name AS brandName,product_brand.brand_media AS brandImage ,languages.* FROM product_brand
        LEFT JOIN languages ON product_brand.language_id = languages.id WHERE product_brand.id = ' . $id;
        $data = $this->db->query($query);
        $res = $data->getResult();

        $languageModel = new LanguageModel();

        $languges = $languageModel->findAll();
        return view('catelog/brandEdit', ['res' => $res, 'languges' => $languges]);
    }

    //Brand update
    public function update(){
        // $validation = \Config\Services::validation();

        // $rules = [
        //     'brandName' => 'required',
        //     'brandImage' => 'required',
        // ];

        // if(!$this->validate($rules)){
        //     $response = [
        //         'brandName' => [
        //             'status' => 'error',
        //             'message' => 'Brand name is required'
        //         ],
        //         'brandImage' => [
        //             'status' => 'error',
        //             'message' => 'Brand image is required'
        //         ]
        //     ];
        //     return json_encode($response);
        // }

        $productBrandId = $this->request->getPost('productBrandId');
        $languageSelect = $this->request->getPost('languageSelect');
        $brandName      = (string)$this->request->getPost('brandName');
        $brandImage     = $this->request->getFile('brandImage')->getClientName();

        $flag = $this->request->getFile('brandImage');
        $flag->move(ROOTPATH . 'public/BrandImage');

        $data = [
            'language_id' => $languageSelect,
            'brand_name' => $brandName,
            'brand_slug' => url_title($brandName, '-', true),
            'brand_media' => $brandImage
        ];

        $res = $this->productBrandModel->update($productBrandId, $data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Product brand update successfully'
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Product brand update failed'
            ];
            return json_encode($response);
        }
    }

    //Brand Delete
    public function delete(){
        $brandId = $this->request->getPost('id');

        $res = $this->productBrandModel->delete($brandId);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Brand was successfully deleted',
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'success',
                'message' => 'Brand was delete failed',
            ];
            return json_encode($response);
        }
    }
}
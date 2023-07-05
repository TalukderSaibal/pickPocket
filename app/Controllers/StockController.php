<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\ProductModel;

class StockController extends BaseController
{
    protected $stockModel;

    public function __construct()
    {
        $this->stockModel = new StockModel();
    }

    /**
     * Stock List Method
     */
    public function index(){

    }

    /**
     * Stock create form view method
     */
    public function stockCreate(){
        $productModel = new ProductModel;

        $data = [
            'products' => $productModel->findAll(),
        ];

        return view('Inventory/stockCreate', $data);
    }

    /**
     * Stock Create method
     */
    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'productName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'status' => 'error',
                'errors' => $validation->getErrors()
            ];
            return json_encode($response);
        }

        $data = [
            'product_id' => $this->request->getPost('productName')
        ];

        $res = $this->stockModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Stock created successfully'
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Stock created failed'
            ];
            return json_encode($response);
        }
    }
}
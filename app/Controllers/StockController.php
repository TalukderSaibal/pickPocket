<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\ProductModel;
use App\Models\StockTransferModel;

class StockController extends BaseController
{
    protected $stockModel,$db;

    public function __construct()
    {
        $this->stockModel = new StockModel();
        $this->db         = \Config\Database::connect();
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

    /**
     * Stock Transfer form view method
     */
    public function transferCreate(){
        $query = 'SELECT * FROM  warehouses';
        $res = $this->db->query($query);

        $productModel = new ProductModel;

        $data = [
            'warehouses' => $res->getResult(),
            'products'   => $productModel->findAll(),
        ];

        return view('Inventory/stockTransfer', $data);
    }

    /**
     * Stock Transfer insert method
     */
    public function transferAdd(){
        $validation = \Config\Services::validation();

        $rules = [
            'warehouseFrom' => 'required',
            'warehouseTo'   => 'required',
            'referenceNo'   => 'required',
            'stockTransfer' => 'required',
            'productId'     => 'required',
            'stockNote'     => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'status' => 'error',
                'errors' => $validation->getErrors()
            ];
            return json_encode($response);
        }

        $data = [
            'warehouse_from' => $this->request->getPost('warehouseFrom'),
            'warehouse_to'   => $this->request->getPost('warehouseTo'),
            'reference_no'   => $this->request->getPost('referenceNo'),
            'transfer_date'  => $this->request->getPost('stockTransfer'),
            'product_id'     => $this->request->getPost('productId'),
            'transfer_note'  => $this->request->getPost('stockNote'),
        ];

        $stockTransferModel = new StockTransferModel;

        $res = $stockTransferModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Transfer added successfully'
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Transfer added failed'
            ];
            return json_encode($response);
        }
    }
}
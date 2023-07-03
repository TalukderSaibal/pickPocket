<?php

namespace App\Controllers;

use App\Models\ProductUnitModel;
use App\Models\LanguageModel;

class ProductUnitController extends BaseController
{
    protected $productUnitModel,$db;

    public function __construct()
    {
        $this->db               = \Config\Database::connect();
        $this->productUnitModel = new ProductUnitModel();
    }

    public function index()
    {
        $query = 'SELECT id,language_name FROM  languages';
        $res = $this->db->query($query);

        $data = [
            'languages' => $res->getResult(),
            'units'     => $this->productUnitModel->paginate(6),
            'pager'     => $this->productUnitModel->pager,
        ];

        return view('catelog/productUnit', $data);
    }

    //Unit create
    public function create()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'unitName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'unitName' => [
                    'status' => 'error',
                    'message' => 'Unit name is required',
                ]
            ];
            return json_encode($response);
        }

        $data = [
            'language_id' => $this->request->getPost('languageSelect'),
            'unit_name'   => $this->request->getPost('unitName')
        ];

        $res = $this->productUnitModel->insertData($data);

        if($res == true){
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

    //Unit update form view method
    public function unitEdit($id){
        $query = 'SELECT * FROM product_unit
        LEFT JOIN languages ON product_unit.language_id = languages.id
        WHERE product_unit.unit_id = ' . $id;
        $data = $this->db->query($query);
        $res = $data->getResult();

        $languageModel = new LanguageModel();

        $languges = $languageModel->findAll();


        return view('catelog/productUnitEdit', ['res' => $res, 'languges' => $languges]);
    }

    //Product Unit update method
    public function update(){
        $validation = \Config\Services::validation();

        $rules = [
            'unitName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'unitName' => [
                    'status' => 'error',
                    'message' => 'Unit name is required',
                ],
            ];

            return json_encode($response);
        }

        $unitId         = $this->request->getPost('unitId');
        $languageSelect = $this->request->getPost('languageSelect');
        $unitName       = $this->request->getPost('unitName');

        $data = [
            'language_id' => $languageSelect,
            'unit_name'   => $unitName,
        ];

        $res = $this->productUnitModel->updateData($unitId, $data);

        if($res == true){
            $response =[
                'status' => 'success',
                'message' => 'Unit was successfully updated',
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Unit could not be updated',
            ];
            return json_encode($response);
        }
    }


    //Prodcut Unit Delete
    public function delete($id){
        $res = $this->productUnitModel->deleteData($id);

        if($res == true){
            return redirect()->to('/product/units');
        }
    }
}
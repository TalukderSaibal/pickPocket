<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;

class ProductController extends BaseController
{
    protected $productModel,$db;

    public function __construct(){
        $this->productModel = new ProductModel();
        $this->db           = \Config\Database::connect();
    }

    public function index(){
        $query = 'SELECT id,language_name FROM  languages';
        $res = $this->db->query($query);

        $categoryModel = new ProductCategoryModel();

        $data = [
            'languages' => $res->getResult(),
            'categories' => $categoryModel->findAll(),
            // 'attributes'     => $this->productModel->paginate(6),
            // 'pager'     => $this->productModel->pager,
        ];
        return view('catelog/product', $data);
    }

    /**
     * Creates a new Product
     */
    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'productName' => 'required',
            // 'productImage' => 
            //     'uploaded[image]',
            //     'mime_in[image,image/jpg,image/jpeg,image/png,image/jpg, image/webpp]',
            //     'max_size[image,1024]',
            'description' => 'required',
            'emebededCode' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'status' => 'error',
                'errors' => $validation->getErrors()
            ];

            return json_encode($response);
        }

        $productImage = $this->request->getFile('productImage')->getClientName();
        $categoryId   = $this->request->getPost('categoryId');
        $languageId   = $this->request->getPost('languageId');
        $productName  = $this->request->getPost('productName');
        $description  = $this->request->getPost('description');
        $emebededCode = $this->request->getPost('emebededCode');

        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $flag = $this->request->getFile('productImage');
        $flag->move(ROOTPATH. 'public/products/'.$year.'/'.$month.'/'.$day);

        $data = [
            'product_media'       => $productImage,
            'category_id'         => $categoryId,
            'language_id'         => $languageId,
            'product_name'        => $productName,
            'product_description' => $description,
            'video_code'          => $emebededCode,
        ];

        $res = $this->productModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Product successfully inserted'
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Product inserted failed'
            ];
            return json_encode($response);
        }
    }
}
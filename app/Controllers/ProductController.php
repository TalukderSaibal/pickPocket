<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductUnitModel;
use App\Models\ProductBrandModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductAdvanceModel;
use App\Models\ProductSeoModel;

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
        $unitModel = new ProductUnitModel();
        $brandModel = new ProductBrandModel();

        $data = [
            'languages' => $res->getResult(),
            'categories' => $categoryModel->findAll(),
            'units' => $unitModel->findAll(),
            'brands' => $brandModel->findAll(),
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

        $productId = $this->productModel->getInsertID();

        if($res){
            $response = [
                'productId' => $productId,
                'status' => 'success',
                'message' => 'Product successfully inserted',
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

    /**
     * Advance Product create method
     */
    public function advanceCreate(){
        $validation = \Config\Services::validation();

        $rules = [
            'productType'   => 'required',
            'isActive'      => 'required',
            'isPoint'       => 'required',
            'isFeature'     => 'required',
            'unitName'      => 'required',
            'brandName'     => 'required',
            'productWeight' => 'required',
            'productPrice'  => 'required',
            'discountPrice' => 'required',
            'minOrder'      => 'required',
            'maxOrder'      => 'required',
            'sku'           => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'status' => 'error',
                'errors' => $validation->getErrors()
            ];
            return json_encode($response);
        }

        $productAdvanceModel = new ProductAdvanceModel;

        $data = [
            'product_id'     => $this->request->getPost('productId'),
            'product_type'   => $this->request->getPost('productType'),
            'is_active'      => $this->request->getPost('isActive'),
            'is_point'       => $this->request->getPost('isPoint'),
            'is_feature'     => $this->request->getPost('isFeature'),
            'unit_id'        => $this->request->getPost('unitName'),
            'brand_id'       => $this->request->getPost('brandName'),
            'product_weight' => $this->request->getPost('productWeight'),
            'product_price'  => $this->request->getPost('productPrice'),
            'discount_price' => $this->request->getPost('discountPrice'),
            'min_order'      => $this->request->getPost('minOrder'),
            'max_order'      => $this->request->getPost('maxOrder'),
            'sku'            => $this->request->getPost('sku'),
        ];

        $res = $productAdvanceModel->insert($data);

        if($res){
            $response = [
                'status'  => 'success',
                'message' => 'Product advance created successfully',
            ];
            return json_encode($response);
        }else{
            $response = [
                'status'  => 'failed',
                'message' => 'Product advance created failed',
            ];
            return json_encode($response);
        }
    }

    //Seo Product Create Method
    public function seoCreate(){
        $validation = \Config\Services::validation();

        $rules = [
            'metaTags'       => 'required',
            'seoDescription' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'status' => 'error',
                'errors' => $validation->getErrors()
            ];

            return json_encode($response);
        }

        $productSeoModel = new ProductSeoModel();

        $data = [
            'product_id'           => $this->request->getPost('seoProductId'),
            'seo_meta_tag'         => $this->request->getPost('metaTags'),
            'seo_meta_description' => $this->request->getPost('seoDescription')
        ];

        $res = $productSeoModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Product Seo created successfully'
            ];
            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Product Seo created failed'
            ];
            return json_encode($response);
        }
    }
}
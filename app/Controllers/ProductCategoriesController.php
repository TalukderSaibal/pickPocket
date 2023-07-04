<?php

namespace App\Controllers;

use App\Models\ProductCategoryModel;

class ProductCategoriesController extends BaseController
{
    protected $productCategoryModel,$db;

    public function __construct(){
        $this->productCategoryModel = new ProductCategoryModel();
        $this->db                = \Config\Database::connect();
    }

    public function index(){
        $query = 'SELECT id,language_name FROM  languages';
        $res = $this->db->query($query);

        $data = [
            'languages' => $res->getResult(),
            'categories' => $this->productCategoryModel->findAll(),
            'categoryData'     => $this->productCategoryModel->paginate(6),
            'pager'     => $this->productCategoryModel->pager,
        ];
        return view('catelog/productCategory', $data);
    }

    //Category create method
    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'categoryName' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'categoryName' => [
                    'status' => 'error',
                    'message' => 'Attribute name is required',
                ]
            ];
            return json_encode($response);
        }

        $languageSelect = $this->request->getPost('languageSelect');
        $categoryName   = $this->request->getPost('categoryName');
        $description    = $this->request->getPost('description');
        $parentCategory = $this->request->getPost('parentCategory');
        $categorySlug   = $this->request->getPost('categorySlug');
        $categoryImage  = $this->request->getFile('categoryImage')->getClientName();
        $categoryIcon   = $this->request->getFile('categoryIcon')->getClientName();

        $media = $this->request->getFile('categoryImage');
        $media->move(ROOTPATH . 'public/categoryImage');

        $icon = $this->request->getFile('categoryIcon');
        $icon->move(ROOTPATH. 'public/categoryIcon');

        $data = [
            'language_id'          => $languageSelect,
            'category_name'        => $categoryName,
            'category_description' => $description,
            'parent_category'      => $parentCategory ? $parentCategory : 0,
            'category_slug'        => $categorySlug,
            'category_media'       => $categoryImage,
            'category_icon'        => $categoryIcon,
        ];

        $res = $this->productCategoryModel->insert($data);

        if($res){
            $response = [
                'status' => 'success',
                'message' => 'Category created successfully',
            ];

            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Category creation failed',
            ];

            return json_encode($response);
        }
    }
}
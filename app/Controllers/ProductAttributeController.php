<?php

namespace App\Controllers;

use App\Models\ProductAttributeModel;

class ProductAttributeController extends BaseController
{
    protected object $productAttributeModel,$db;

    public function __construct(){
        $this->productAttributeModel = new ProductAttributeModel();
    }

    //Product attribute List
    public function index(){
        return view('catelog/productAttribute');
    }

    //Product attribute create
    public function create(){

    }
    
}
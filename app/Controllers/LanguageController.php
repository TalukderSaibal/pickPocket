<?php

namespace App\Controllers;

class LanguageController extends BaseController
{
    public function index(){
        return view('language/add_language');
    }
}
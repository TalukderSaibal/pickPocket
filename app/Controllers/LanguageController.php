<?php

namespace App\Controllers;

use App\Models\LanguageModel;

class LanguageController extends BaseController
{
    protected $languageModel;

    public function __construct()
    {
        $this->languageModel = new LanguageModel();
    }


    public function index(){
        $data = [
            'languages' => $this->languageModel->paginate(6),
            'pager' => $this->languageModel->pager,
        ];
        return view('language/languageList', $data);
    }

    //Language Form view
    public function languageAdd(){
        return view('language/add_language');
    }

    //Language create
    public function create(){
        $validation = \Config\Services::validation();

        $rules = [
            'languageName' => 'required',
            'languageCode' => 'required',
        ];

        if(!$this->validate($rules)){
            $response = [
                'languageName' => [
                    'status' => 'failed',
                    'message' => 'Name is required',
                ],

                'languageCode' => [
                    'status' => 'failed',
                    'message' => 'Code is required',
                ],
            ];

            return json_encode($response);
        }

        $name = $this->request->getPost('languageName');
        $code = $this->request->getPost('languageCode');

        $data = [
            'language_name' => $name,
            'language_code' => $code,
        ];

        $res = $this->languageModel->inserData($data);

        if($res == true){
            $response = [
                'status'      => 'success',
                'message'     => 'Language created successfully',
                'statusCodes' => 200
            ];

            return json_encode($response);
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'Language created failed',
                'statusCodes' => 501
            ];
            return json_encode($response);
        }
    }
}
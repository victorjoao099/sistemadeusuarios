<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class InicialController extends BaseController
{
    public function index()
    {
        return view('inicial');
    }
    public function logout()
    {
            $logoutModel = new UserModel();
            $logoutModel->save(['logoutTime' => date('Y-m-d H:i:s')]);
        

        session()->destroy();

        return $this->response->getJSON(['status' => 'success']);
    }
}

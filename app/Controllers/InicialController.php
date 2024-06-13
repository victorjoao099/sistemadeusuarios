<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InicialController extends BaseController
{
    public function index()
    {
        return view('inicial');
    }
    public function logout()
    {
        session()->destroy();

        return $this->response->setJSON(['status' => 'success']);
    }
}

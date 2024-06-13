<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('login');
    }

    public function entrar()
    {
        if($this->request->isAJAX()){
            $usuarioModel = new UserModel();
            $usuarioCheck = $usuarioModel->check(
                $this->request->getPost('email'),
                $this->request->getPost('senha')
            );
            if(!$usuarioCheck){
                return $this->respond("Usuário e/ou senha inválidos, por favor, tente novamente", 400);
            }
                $data = [
                    'status' => 'success',
                    'msg' => 'okok',
                    'route' => route_to('inicial.index'),
                ];

                session()->set($data);

                return $this->respond($data);
        }
    }
}

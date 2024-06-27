<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class CadastroController extends BaseController
{   

    use ResponseTrait;

    public function index()
    {
        return view('cadastro');
    }

    public function cadastrar()
    {
        if($this->request->isAJAX()){
            $userModel = new UserModel();
            $userData = $this->request->getPost();


            //  Checa o email para ver se ele não está cadastrado.
            if($userModel->check($userData['email'], $userData['senha'])){
                return $this->respond("não é possível criar conta com esse email", 400);
            }
            else{

            }
            try{
                if ($userModel->save($userData)){
                    $data = [
                        'status' => 'success',
                        'message' => 'deu tudo certo',  // Salva os dados e rediciona para a página inicial
                        'route' => route_to('inicial.index'),
                    ];

                    return $this->respond($data);
                }
            }   catch(Exception $e){
                return $this->respond('Erro', 500);

            }
        }
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\ResponseInterface;

class InicialController extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        return view('inicial');
    }

    public function logout()
    {

        $userModel = new UserModel();

        date_default_timezone_set('America/Sao_Paulo'); //Muda o fuso-horário
        $mytime = new Time('now'); // Captura o horáiro

        $data = array( 
            'ultimoLogin' => $mytime,  // Transforma a coluna último login para o horário atual
        );

        $session = session()->get('loginData')['userData']; // Captura dados da sessão

        $id = $session['id']; // Captura o id da sessão

        if ($userModel->update($id, $data)){
            session()->destroy();
            return $this->response->setJSON(['status' => 'success']); // Faz update do horário de logout, destroi a sessão e redireciona
        };
    }
    
}
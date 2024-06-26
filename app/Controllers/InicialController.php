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
        // dd($userModel);
        // dd($localTime);

        date_default_timezone_set('America/Sao_Paulo'); //Muda o fuso-horário
        $mytime = new Time('now'); // Captura o horáiro

        // dd($mytime);

        $data = array( 
            'ultimoLogin' => $mytime,
        );

        // $session = session()->userData;
        $session = session()->get('loginData')['userData'];

        $id = $session['id'];


        // dd($session);

        if ($userModel->update($id, $data)){
            session()->destroy();
            return $this->response->setJSON(['status' => 'success']);
        };


        // if ($this->request->isAJAX()){
        //     return $this->response->setJSON(['status' => 'success', 'message' => 'Sessão fechada com sucesso']);
        // }
    }
    
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\UserModel;

class Users extends BaseController
{
 
    private $usersModel;

    public function __construct()
    {
        $this->usersModel = new UserModel();
    }

    //
    public function index()
    {
        

        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        if ($userInfo['type'] == 'admin'){
        $dados = [
            'title' => 'Users',
            'userAll' => $userModel->findAll(),
            'userInfo' => $userInfo,
        ];
        return view('user/user', $dados);
    }else{
            return redirect()->to('dashboard')->with(
                'fail',
                'You must be an admin'
            );
    }  
    }
    public function buttons(){
        $uri = current_url(true);
        $idUsers = $uri->getSegment(4);
        $this->usersModel->delete(['id' => $idUsers]);
        return redirect()->back();
    }
    public function form(){
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $dados = [
            'title' => 'Form',
            'userInfo' => $userInfo,
        ];
        return view('user/formUser',$dados);
    }
    public function register(){
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $validated = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your full Name is required'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'Your email is required',
                    'valid_email' => 'Email is already used.',
                    'is_unique' => 'Email is already being used',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required',
                    'min_length' => 'Password must be 5 charactars long',
                    'max_length' => 'Password cannot be longer than 20 charectars'
                ]
            ], 
        ]);
        $dados = [
            'title' => 'Form', 
            'userInfo' => $userInfo,
        ];

        if(!$validated){
            return view('user/formUser', ['validation' => $this->validator]);
            
        }

        $params = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => Hash::encrypt($this->request->getPost('password')),
            'type' => $this->request->getPost('type')
        ];
        $db = db_connect();
        $db->query("INSERT INTO user VALUES (DEFAULT, :name:, :email:, :password:, :type:)", $params);
        $db->close();

        return $this->response->redirect(site_url('user'));
    }

}

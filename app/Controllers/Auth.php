<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Libraries\Hash;
use App\Models\UserModel;
use PHPUnit\Framework\MockObject\Exception;

class Auth extends BaseController
{

    // Enabling features
    public function __construct()
    {
        helper(['url', 'form']);
    }

    /**
     * Responsible for login page view.
     */
    public function index()
    {
        return view('auth/login');
    }

    /**
     * Responsible for register page view.
     */
    public function register(){
        return view('auth/register');
    }

    /**
     * Save new user to database
     */
    public function registerUser(){
        // Validate user input.

        // $validated = $this->validate([
        //     'name'         => 'required',
        //     'email'        => 'required|valid_email',
        //     'password'     => 'required|min_length[5]|max_length[20]',
        //     'passwordConf' => 'required|min_length[5]|max_length[20]|matches[password]',
        // ]);

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
            'passwordConf' => [
                'rules' => 'required|min_length[5]|max_length[20]|matches[password]',
                'errors' => [
                    'required' => 'Your conform password is required',
                    'min_length' => 'Password must be 5 charactars long',
                    'max_length' => 'Password cannot be longer than 20 charectars',
                    'matches' => 'Confirm password must match the password'
                ]
            ],
        ]);

        if(!$validated){
            return view('auth/register', ['validation' => $this->validator]);
        }

        // Here we save the user.

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConf = $this->request->getPost('passwordConf');

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::encrypt($password)
        ];

        // Storing data
        
        $userModel = new \App\Models\UserModel();
        $query = $userModel->insert($data);

        if(!$query)
        {
            return redirect()->back()->with('fail', 'Saving user failed');
        } 
        else
        {
            return redirect()->back()->with('success', 'User add successfully');
        }
    }

    /**
     * User login method
     */
    public function loginUser(){

        // Validating user input.

        $validated = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required',
                    'valid_email' => 'Email is already used.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required',
                    'min_length' => 'Password must be 5 charactars long',
                    'max_length' => 'Password cannot be longer than 20 charectars'
                ]
            ]
        ]);

        if(!$validated){
            return view('auth/login', ['validation' => $this->validator]);
        }
        else
        {
            // Checking user details in database.

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $userInfo = $userModel->where('email', $email)->first();

            $checkPassword = Hash::check($password, $userInfo['password']);

            if(!$checkPassword)
            {
                session()->setFlashdata('fail', 'Incorrect password provided');
                return redirect()->to('auth');
            }
            else
            {
                // Process user info.

                $userId = $userInfo['id'];

                session()->set('loggedInUser', $userId);
                return redirect()->to('dashboard');
            }
        }
    }

    /**
     * Log out the user.
     */
    public function logout(){
        
        if(session()->has('loggedInUser')){
            session()->remove('loggedInUser');
        }

        return redirect()->to('auth?access=loggedout')->with('fail', 
        'You are logged out');
    }
}

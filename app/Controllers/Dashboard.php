<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MovimentModel;

class Dashboard extends BaseController
{ 
    private $movimentModel;

    public function __construct()
    {
        $this->movimentModel = new MovimentModel();
    }

    public function index()
    {  

        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $db = db_connect();
        $db->close();


        $data = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo,
            'outputArray' => $this->movimentModel->where('type', 'input')->findAll(),
            'inputArray' => $this->movimentModel->where('type','output')->findAll(),
            'fullArray' => $this->movimentModel->findAll(),
            'inputAll' =>$this->movimentModel->selectSum('value')->where('type','input')->findAll(),
            'outputAll' =>$this->movimentModel->selectSum('value')->where('type','output')->findAll(),
        ];

        return view('dashboard/index', $data);
    }


}

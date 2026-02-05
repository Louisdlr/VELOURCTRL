<?php
namespace App\controllers;

use App\Models\User;

class connectionController extends Controller{

    public function login()
    {
        return $this->display("auth.index");
    }

    public function create()
    {
        return $this->display("auth.create");
    }
    

    // public function logout()
    // {
    //         session_destroy();
    //         return header('location: /mvc/');
    // }

    public function logout()
    {
        session_destroy();
        return header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');
    }

}
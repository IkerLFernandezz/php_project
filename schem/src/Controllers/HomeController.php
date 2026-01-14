<?php

namespace App\Controllers;

use App\Infrastructure\Http\Response;
use App\Domain\User\User;

class HomeController{
    public function index(){
        $user = new User("1", "Pep", "pep@pep.com");
        //$response = new Response();
        //$respJson = $response->json($user, 200);
        //$respJson->send();

        $response = new Response();
        $response->html('home', ['user' => $user]);
        //$response->send();

        //return view ('home',['user' => $user]);
    }
    public function login(){
        //echo 'Login Page';
    }
}
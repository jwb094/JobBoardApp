<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

class UserAuthService{

    public function register(){
        
    }

    public function login(array $loginDetails){

     return Auth::attempt([
        'email' => $loginDetails['email'],
        'password' => $loginDetails['password']
     ]);
    }

    public function logout(){
        
    }

}
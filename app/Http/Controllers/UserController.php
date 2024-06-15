<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller 
{
    //Funcao para o login
    public function login(Request $request){
        $credenciais = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        //Se houver match inicia a sessao
        if (auth()->attempt(['name' => $credenciais['loginname'], 'password'=> $credenciais['loginpassword']])) {
            $request->session()->regenerate();

        }
        return redirect('/');
    }

    //funcao logout
    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    //funcao para registrar o usuario
    // ele vai buscar os inputs do utilizador e mostrar na tela 
    public function register(Request $request){
        $credenciais = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        //Encripitar as passwords dos Users que vao para a DB
        $credenciais['password'] = bcrypt($credenciais['password']);
        //Criacao do user
        $user = User::create($credenciais);
        auth()->login($user);
        return redirect('/');
    }
}

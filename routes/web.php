<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});

//Rota para registar um User, uso dois argumentos a,b.
//primeiro argumento URL
//segundo argumento é a funcao que quero rodar
//ele associou a url register que escolhi e vai buscar ao html no action do formulario com o mesmo nome, vai a funcao onde diz que a url /register tem que retornar a view "etc" 
//protocolo http "post" é porque ele vai enviar informacoes ou seja inputs do utilizador para o sistema.
Route::post('/register', [UserController::class, 'register']);
//Rota para logout 
Route::post('/logout', [UserController::class, 'logout']);
//Rota para login 
Route::post('/login', [UserController::class, 'login']);

//Criador de tarefas routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'TarefaAtualizada']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
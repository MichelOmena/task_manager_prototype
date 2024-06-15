<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post){
        if (auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');
    }
    
    public function TarefaAtualizada(Post $post, Request $request) {
        if (auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $credenciais = $request->validate([
            'title' => 'required',
            'body' => 'required'

        ]);

        $credenciais['title'] = strip_tags($credenciais['title']);
        $credenciais['body'] = strip_tags($credenciais['body']);

        $post->update($credenciais);
        return redirect('/');
    }
    public function showEditScreen(Post $post){
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['post' =>$post]);
    }
    //funcao para criar tarefas(post)
    public function createPost(Request $request){
        if (auth()->check())
        $credenciais = $request->validate([
            'title'=> 'required',
            'body' => 'required',
        ]);

        $credenciais['title'] = strip_tags($credenciais['title']);
        $credenciais['body'] = strip_tags($credenciais['body']);
        $credenciais['user_id'] = auth()->id();
        Post::create($credenciais);
        return redirect('/');

    }
}

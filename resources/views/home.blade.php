<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criador_Tarefas</title>
    <!--style-->
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 2px solid #e7e7e7;
            position: relative;
        }
        .navbar .title{
            flex: 1;
            text-align: left;
            font-size: 1.2em;
            font-weight: bold;
        }

        .navbar .center{
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            
        }

        .navbar .nav-items {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .navbar h1, .navbar p, .navbar button {
            margin:0;
        }
       
    </style>
</head>
<body>
    <div class="navbar">
        <div class ="title">Gestor de Tarefas Domesticas</div>
        @auth
        <div class="center">
        <h1><strong>Bem-Vindo(a)</strong>, {{ auth()->user()->name }}.</h1>
    </div>
    <div class="nav-items">
        <form action="/logout" method="POST">
            @csrf
            <button>Sair</button>
        </form>
    </div>
        @endauth
    </div>

    @auth
    <h1>Login realizado com sucesso</h1>
    

    <div style="border: 3px solid black;">
        <h2>Criar nova tarefa</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="titulo da tarefa">
            <textarea name="body" placeholder="conteúdo"></textarea>
            <label for="deadline">Prazo de Entrega:</label>
            <input type="datetime-local" id="deadline" name="deadline">
            <button>Salvar Tarefa</button>
        </form>
    </div>

    <div style="border: 3px solid black;">
        <h2>Todas as Tarefas</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} , Autor: {{$post->user->name}}</h3>
            {{$post['body']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Apagar</button>
            </form>
        </div>
        @endforeach
    </div>

    @else   
    <div style="border: 5px solid black;">
        <h2>Registo de Usuario</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Registar</button>
        </form>
        </div>
   
    <div style="border: 5px solid black;">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button>Entrar</button>
        </form>
        </div>
    @endauth

   
</body>
</html>
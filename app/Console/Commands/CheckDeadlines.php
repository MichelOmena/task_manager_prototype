<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\Notifications\DeadlineApproaching;
use Illuminate\Support\Facades\Notification;

class CheckDeadlines extends Command
{
    protected $signature = 'check:deadlines';

    protected $description = 'Check deadlines of posts and notify users';

    public function _construct(){
        parent::_construct();
    }
  
    public function handle()
    {
        // Encontre todas as tarefas cuja a deadlines é amanha
        $posts = Post::whereDate('dealine', now()->addDays()->toDateString())->get();
        foreach ($posts as $post){
            $user =$post->user;
            Notification::send($user, new DeadlineApproaching($post));
        }

        $this->info('Notificacoes de prazo enviadas com sucesso.');
    }
}

<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RepliedToThread extends Notification
{
    use Queueable;

    //public $class;

    public $list;

    public $task;

    public $user;

    public $act;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($list,$task,$act,$user)
    {
        //$this->class = $class;
        $this->list = $list;
        $this->task = $task;
        $this->act = $act;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'list' => $this->list,
            'task' => $this->task,
            'act'  => $this->act,
            'user' => $this->user,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'task' => $this->task,
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /*public function toArray($notifiable)
    {
        return $this->task->toArray();
    }*/
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CommentNotification extends Notification
{
    use Queueable;
    public $post;
    public $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct($post, $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_owner_id' => $this->post->user_id,
            'commented_user' => [
                'id' => $this->comment->user_id, // L'ID de l'utilisateur qui a commenté
                'name' => $this->comment->user->username, // Le nom de l'utilisateur qui a commenté
            ],
            'commented_message' => $this->comment->content, // Contenu du commentaire
            'message' => 'commented on your post',
            'post_title' => $this->post->title,
        ];
    }
    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'message' => 'commented on your post'
        ]);
    }
    public function broadcastOn()
    {
        return ['my-channel'];
    }
}

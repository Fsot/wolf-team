<?php

namespace wolfteam\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ModeratedForumMessage extends Notification
{
    use Queueable;
    /**
     * @var
     */
    private $msg;
    /**
     * @var
     */
    private $thread;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msg, $thread)
    {
        $this->msg = $msg;
        $this->thread = $thread;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->msg->text,
            'thread' => $this->thread->slug,
            'doModerate' => $this->msg->doModerate
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendEmailUser extends Notification
{
    use Queueable;

    /**
     * @var object
     */
    protected $user;

    /**
     * @var string
     */
    protected $subject;

    /**
     * Create a new notification instance.
     *
     * @param object $user    user details
     * @param string $subject subject for email
     *
     * @return void
     */
    public function __construct($user, $subject)
    {
        $this->user    = $user;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line('Please use credentials below to login:')
            ->line('Email: ' . $this->user->email)
            ->line('Password: ' . $this->user->password)
            ->action('Login', url('/'))
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            //
        ];
    }
}

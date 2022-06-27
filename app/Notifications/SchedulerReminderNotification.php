<?php

namespace App\Notifications;

use App\Models\Scheduler;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SchedulerReminderNotification extends Notification
{
    use Queueable;

    protected $scheduler;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Scheduler $scheduler)
    {
        //
        $this->scheduler = $scheduler;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->subject("Recordatorio de cita")
                    ->greeting("Hola {$this->scheduler->staffUser->name}")
                    ->line("Recuerda que tienes una cita hoy a las {$this->scheduler->from->format('H:i')}")
                    ->action('Ver agenda', url('/staff-scheduler'));
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
            //
        ];
    }
}

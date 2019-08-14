<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrcamentoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $pdf;

    protected $orcamento;


    public function __construct($pdf,$orcamento)
    {
        $this->pdf = $pdf;

        $this->orcamento = $orcamento;

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
        $pdf = $this->pdf;

        $entity = $this->orcamento;


        return (new MailMessage)
            ->view('pdfs.orcamentos',compact('entity'))
            ->attachData($pdf, date("Y-m-d"). '_' . '.pdf',
                [
                    'mime' => 'application/pdf',
                ]);
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

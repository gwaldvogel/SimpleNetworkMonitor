<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Sensor;
use App\Event;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    private $event;
    private $sensor;

    /**
     * Create a new message instance.
     *
     * @param $event the event that triggered this notification
     * @param $sensor the sensor that triggered this event
     * @return void
     */
    public function __construct(Event $event, Sensor $sensor)
    {
        $this->event = $event;
        $this->sensor = $sensor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification')
            ->subject('PiSec Notification')
            ->with([
                "eventType" => $this->event->type,
                "createdAt" => $this->event->created_at,
                "sensorDescription" => $this->sensor->description
            ]);
    }
}

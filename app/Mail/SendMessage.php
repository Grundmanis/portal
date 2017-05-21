<?php

namespace App\Mail;

use App\Advert;
use App\Http\Requests\MessageRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $advert;

    /**
     * Create a new message instance.
     *
     * @param Advert $advert
     * @param MessageRequest $request
     */
    public function __construct(Advert $advert, MessageRequest $request)
    {
        $this->advert = $advert;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->request->email)
            ->subject('Message from "Latvijas Portals"')
            ->view('emails.sendMessage');
    }
}

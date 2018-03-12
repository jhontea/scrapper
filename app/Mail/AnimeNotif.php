<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnimeNotif extends Mailable
{
    use Queueable, SerializesModels;

    protected $anime;
    protected $data;
    protected $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($anime, $data, $title)
    {
        $this->anime = $anime;
        $this->data = $data;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
            ->view('emails.anime.notif')
            ->with([
              'data'    => $this->data,
              'anime'   => $this->anime
            ]);
    }
}

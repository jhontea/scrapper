<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MangaNotif extends Mailable
{
    use Queueable, SerializesModels;

    protected $manga;
    protected $data;
    protected $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($manga, $data, $title)
    {
        $this->manga = $manga;
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
            ->view('emails.manga.notif')
            ->with([
              'data'    => $this->data,
              'manga'   => $this->manga
            ]);
    }
}

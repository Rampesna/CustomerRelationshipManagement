<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PriceListMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['subject'])->
        markdown('emails.priceList', [
            'data' => $this->data
        ])->attach(public_path('priceLists/' . $this->data['priceList']->id . '.pdf'), [
            'as' => $this->data['priceList']->name . '.pdf',
            'mime' => 'application/pdf'
        ]);
    }
}

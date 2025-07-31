<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class LaporanMasuk extends Mailable
{
    use Queueable, SerializesModels;

    public $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Baru Masuk'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.laporan-masuk',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath(storage_path('app/public/' . $this->laporan->file_path))
                ->as('bukti-laporan.webp') // Nama file di email
                ->withMime('image/webp'),
        ];
    }
}

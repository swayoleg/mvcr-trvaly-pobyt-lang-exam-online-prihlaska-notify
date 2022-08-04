<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\Notify;

use Swayoleg\CestinaCheck\DocDownload\DocDownloadInterface;

class EmailNotifier {

    protected DocDownloadInterface $downloader;
    protected array $options;

    public function __construct($options, DocDownloadInterface $downloader) {
        $this->downloader = $downloader;
        $this->options = $options;
    }

    public function notify($message = ''): void {
        $toArray      = $this->options['sendTo'];
        $subject = $this->options['subject'] ?? ' New exam spot';
        $from = $this->options['from'] ?? 'webmaster@example.com';
        $reply = $this->options['replyTo'] ?? 'webmaster@example.com';
        $headers = 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $reply .  "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        foreach ($toArray as $toEmail) {
            @mail($toEmail, $subject, $message, $headers);
        }
    }



}

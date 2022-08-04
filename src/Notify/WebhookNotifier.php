<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\Notify;

use Swayoleg\CestinaCheck\DocDownload\DocDownloadInterface;

class WebhookNotifier {

    protected DocDownloadInterface $downloader;
    protected array $options;

    public function __construct($options, DocDownloadInterface $downloader) {
        $this->options = $options;
        $this->downloader = $downloader;
    }

    public function notify($message = ''): void {
        $urls = $this->options['urls'];
        foreach ($urls as $url) {
            $url .= "?message=" . urlencode($message);
            $this->downloader->getDocument($url);
        }
    }

}

<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck;

use Swayoleg\CestinaCheck\DocDownload\DocDownloadInterface;
use Swayoleg\CestinaCheck\Dom\ParserInterface;
use Swayoleg\CestinaCheck\Notify\NotifierInterface;

Class OnlinePrihlaskaChecker {

    private array $config = [];
    private string $content = '';

    protected DocDownloadInterface $downloader;
    protected ParserInterface $domParser;

    /** @var NotifierInterface[]  */
    protected array $notifiers;

    public function __construct(array $config = [])
    {
        $this->config = $config;
        $downloaderClassName = 'Swayoleg\CestinaCheck\DocDownload\DocDownload' . ucfirst($this->config['downloader']);
        $parserClassName = 'Swayoleg\CestinaCheck\Dom\\' . ucfirst($this->config['domParser']) . 'Parser';

        $this->downloader = new $downloaderClassName();
        $this->domParser = new $parserClassName();
        if ($this->config['notify']) {
            foreach ($this->config['notify'] as $notificatorType) {
                $notifierClassName = 'Swayoleg\CestinaCheck\Notify\\' . ucfirst($notificatorType) . 'Notifier';
                $this->notifiers[$notificatorType] = new $notifierClassName($this->config['notify_options'][$notificatorType], $this->downloader);
            }
        }
    }

    public function check() {
        $this->content = $this->downloader->getDocument($this->config['url']);
        if ($this->domParser->hasFreeSpots($this->content, $this->config['noTermsText'])) {
            if ($this->notifiers) {
                foreach ($this->notifiers as $notifier) {
                    $notifier->notify($this->config['message']);
                }
            }

        } elseif(!$this->domParser->hasDisabledLinks() && $this->config['sendNotificationIfNoElementsFound']) {
            foreach ($this->notifiers as $notifier) {
                $notifier->notify($this->config['errorMessage']);
            }
        }
    }

}

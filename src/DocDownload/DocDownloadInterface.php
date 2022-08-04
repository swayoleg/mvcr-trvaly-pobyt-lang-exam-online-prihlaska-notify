<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\DocDownload;

interface DocDownloadInterface {

    /**
     * @return string
     */
    public function getDocument($url): string;
}
<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\DocDownload;

class DocDownloadFile implements DocDownloadInterface {

    /**
     * @return string
     */
    public function getDocument($url): string {
        $result = @file_get_contents($url);
        return $result;
    }

}
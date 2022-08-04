<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\DocDownload;

use GuzzleHttp\Client as Guzzle;

class DocDownloadGuzzle implements DocDownloadInterface {

    /**
     * @return string
     */
    public function getDocument($url): string {
        $client = new Guzzle();
        $result = $client->request('GET', $url);
        return $result->getBody()->getContents();
    }

}
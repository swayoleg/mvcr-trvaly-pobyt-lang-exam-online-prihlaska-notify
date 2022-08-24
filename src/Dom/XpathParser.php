<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\Dom;

use DOMDocument;
use DOMXpath;

class XpathParser implements ParserInterface {

    public int $countOfTotalLinks = 0;

    public const XPATH_HREFS = "//div[@id='registration-wrap']/div[@class='card-body']/ul/li/div[@class='row']/div[contains(@class, 'text-right')]/a";

    public function hasFreeSpots(string $content, array $wordToCheck = ['Obsazeno', 'Nedostupná']): bool
    {
        // Dont you mind that Im using dirty hacks for utf-8 ?
        $doc = new DOMDocument('1.0', 'UTF-8');
        @libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="utf-8" ?>'. PHP_EOL . '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$content);
        $xpath = new DOMXpath($doc);
        $elements = $xpath->query(self::XPATH_HREFS); ///div[contains(@class, 'text-right')]/a
        @libxml_clear_errors();
        $exists = false;
        $this->countOfTotalLinks = (int)$elements->length;
        // 'Total Elements: ' . $elements->length . PHP_EOL;
        foreach ($elements as $element) {
            $txt = trim($element->textContent);
            if (!in_array($txt, $wordToCheck)) {
                $exists = true;
                break;
            }
        }
        //return true; // Yes, I was testing the free spots like that
        return $exists;
    }

    /**
     * In cas that parser didnt find links at all
     * @return bool
     */
    public function hasDisabledLinks(): bool {
        return (bool)$this->countOfTotalLinks;
    }
}

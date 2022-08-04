<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\Dom;

interface ParserInterface {

    public function hasFreeSpots(string $content, string $wordToCheck = 'Obsazeno'): bool;

    public function hasDisabledLinks(): bool;

}
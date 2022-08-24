<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\Dom;

interface ParserInterface {

    public function hasFreeSpots(string $content, array $wordToCheck = ['Obsazeno', 'Nedostupná']): bool;

    public function hasDisabledLinks(): bool;

}
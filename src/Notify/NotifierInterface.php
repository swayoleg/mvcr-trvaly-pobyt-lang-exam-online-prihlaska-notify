<?php

namespace Swayoleg\CestinaCheck\Notify;

interface NotifierInterface {

    public function notify(string $content): void;

}
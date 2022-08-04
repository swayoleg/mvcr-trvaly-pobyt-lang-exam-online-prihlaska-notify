<?php

declare(strict_types=1);

namespace Swayoleg\CestinaCheck\Notify;

use Swayoleg\CestinaCheck\DocDownload\DocDownloadInterface;

class TelegramNotifier {


    static private array $chats = [];
    private string $token = '';

    protected DocDownloadInterface $downloader;

    public function __construct($options, DocDownloadInterface $downloader) {
        self::$chats = $options['chats'];
        $this->token = $options['token'];
        $this->downloader = $downloader;
        //$this->senderClass
    }

    private function getChats(): array
    {
        return self::$chats;
    }

    public function notify($message = ''): void {
        $chats = $this->getChats();
        foreach ($chats as $chat) {
            if (is_string($chat)) {
                $chat = trim($chat);
            }
            $this->sendMessage($chat, $message);
        }
    }

    private function sendMessage($chatID, $messaggio, $token = '') {
        if (!$token) {
            $token = $this->token;
        }

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url .= "&parse_mode=html&text=" . urlencode(str_replace('<br/>',"\r\n", $messaggio));

        $this->downloader->getDocument($url);
    }


}

<?php

require_once __DIR__ . '/vendor/autoload.php';

$configExample = [
    'notify' => [
        'telegram',
        //'email',
        //'webhook'
    ],
    'notify_options' => [
        'telegram' => [
            // can be a lot of chats
            'chats' => [
                '%YOURCHATIDHERE%',
                '%YOURCHATIDHERE%'
            ],
            'token' => '%TELEGRAMTOKEN%', //
        ],
        'email' => [
            // can be multiply
            'sendTo' => [
                'swayoleg@gmail.com'
            ],
            'subject' => 'New exam spot',
            'from' => 'webmaster@example.com',
            'replyTo' => 'webmaster@example.com',
        ],
        'webhook' => [
            // Can be a lot of urls
            'urls' => [
                '%YOUR URL HERE%'
            ]
        ]
    ],

    'url' => 'https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/',
    'noTermsText' => 'Obsazeno',
    'downloader' => 'curl',  // Can be "guzzle", "file" or "curl"
    'domParser' => 'xpath',
    'sendNotificationIfNoElementsFound' => false, // This will notify you if there is no disabled links found - for example in case if DOM scruture is changed.
    'message' => 'New Exam place Exists!' . PHP_EOL . 'Go for it: https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/', // Message to send
    'errorMessage' => 'No xpath elements found',
];

$checker = new \Swayoleg\CestinaCheck\OnlinePrihlaskaChecker($configExample);
$checker->check();


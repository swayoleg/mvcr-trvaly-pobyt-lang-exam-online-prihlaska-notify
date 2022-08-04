<?php

return [
    'url' => 'https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/',
    'noTermsText' => 'Obsazeno',
    'downloader' => 'curl',  // Can be guzzle, file or curl
    'domParser' => 'xpath',
    'message' => 'New Exam place Exists!' . PHP_EOL . 'Go for it: https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/',
    'errorMessage' => 'No xpath elements found',
    'sendNotificationIfNoElementsFound' => true, // This will notify you if there is no disabled links found - for example in case if DOM scruture is changed.
    'notify' => [
        'telegram',
        //'email',
        //'webhook',
    ],
    'notify_options' => [
        'telegram' => [
            'chats' => [
                'ID HERE', // ITS INT ID got to @userinfobot to get it
            ],
            'token' => 'TOKEN HERE', // TOKEN HERE
        ],
        'email' => [
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
                'https://google.com/'
            ]
        ]
    ],
];

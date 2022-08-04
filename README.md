# What is it project for?

In Czech republic to get permanent visa you need to get language exam. 
And there is a big problem to get term and register - they have always no spots.
To get a spot for lang exam you need to go here https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/

So what I did its just simple parser that checks free spot and notifies you.

### Notification and script options

The notification can be done via telegram, email and webhook.
There is two type(styles I would say) to solve the problem. 
In noOOPJustForFunExample.php you just put the telegram token and chat id - and put the script on a cron.
This is my style to solve one-time issues - just get it done.

BUT its not a cool and corporate style - right? So real "for fun" was to create script that can send notification with different type, can operate via guzzle or curl by config, can be extended - bla bla bla.

So if you are novice in this lets go with config. Use parser_example.php file.

If you need to send notification to your BE with webhook use this config:

```php
$configExample = [
    'notify' => [
        'webhook',
    ],
    'notify_options' => [
        'webhook' => [
            'urls' => [
                '%YOUR URL HERE%'
            ]
        ]
    ],
    
    'sendNotificationIfNoElementsFound' => false, // This will notify you if there is no disabled links found - for example in case if DOM scruture is changed.
    'message' => 'New Exam place Exists!' . PHP_EOL . 'Go for it: https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/', // Message to send
    'errorMessage' => 'No xpath elements found',
    
    'url' => 'https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/',
    'noTermsText' => 'Obsazeno',
    'downloader' => 'curl',  // Can be "guzzle", "file" or "curl"
    'domParser' => 'xpath',
];

```
It will send simple GET request to your url with urlEncoded 'message' GET param.

### Telegram notification sending

If you need to send it via telegram - create bot with <a href="https://t.me/BotFather">@BotFather</a>. telegram bot.
Get your **token**.
It will be right after this line
``
Use this token to access the HTTP API:
``

To get your int id of telegram the fastest way is to write to <a href="https://t.me/userinfobot">@userinfobot</a>. It will respond like this:

```
@swayoleg
Id: nnnnnnnn
First: Oleg
Last: Ovsianikov
Lang: en
```

In the nnnnnnnn place you will get your *chat Id* for config.


So send config like this:

```php
$configExample = [
    'notify' => [
        'telegram',
    ],
    'notify_options' => [
        'telegram' => [
            'chats' => [
                *chat Id*
            ],
            'token' => '*token*', // TELEGRAM TOKEN HERE
        ],
    ],
    
    'sendNotificationIfNoElementsFound' => false, // This will notify you if there is no disabled links found - for example in case if DOM scruture is changed.
    'message' => 'New Exam place Exists!' . PHP_EOL . 'Go for it: https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/', // Message to send
    'errorMessage' => 'No xpath elements found',
    
    
    'url' => 'https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/',
    'noTermsText' => 'Obsazeno',
    'downloader' => 'curl',  // Can be "guzzle", "file" or "curl"
    'domParser' => 'xpath',
];

```

If your file_get_contents function is allowed to open urls you can use
``
'downloader' => 'file'
``
as an option. Other options are curl or guzzle.


Other Options:

*url* - the actually url for parsing

*errorMessage* - what should we send if xPath didnt find any links. Works only with sendNotificationIfNoElementsFound

*sendNotificationIfNoElementsFound* - flag if we need to send message if parser cant find the links

*domParser* - leave it for now. If you want another parser add it to src/Dom and implement Swayoleg\CestinaCheck\Dom\ParserInterface

*downloader* - if you use file it uses simple file_get_contents php function - so url open should be allowed. curl uses ext-curl and guzzle use guzzlehttp/guzzle package

*noTermsText* - the btn has Obsazeno vlue - if not you will get notification that spot is there and you can book it

### Multiply notifications

Yes it works. You can use webhook email and telegram notification types same time, and multipy urls, chats and emails as well.

## Coffee

    If you want to by me a coffee - just do it:

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://www.buymeacoffee.com/swayoleg)

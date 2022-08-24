<?php

$telegaToken = 'TELEGA TOKEN HERE!!!'; // Telegram bot token
// Telegram chats to send
$telegaChatIds = [
    'CHAT ID HERE!!!'
]; // <= simplest way to get your tg id is to write to @userinfobot telegram bot

$url = 'https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/';
$content = file_get_contents($url);

$doc = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$doc->loadHTML('<?xml encoding="utf-8" ?>'. PHP_EOL . '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$content);
$xpath = new DOMXpath($doc);
$elements = $xpath->query("//div[@id='registration-wrap']/div[@class='card-body']/ul/li/div[@class='row']/div[contains(@class, 'text-right')]/a"); ///div[contains(@class, 'text-right')]/a
libxml_clear_errors();
$exists = false;
echo 'Total Elements: ' . $elements->length . PHP_EOL;
foreach ($elements as $element) {
    $txt = trim($element->textContent);
    if ($txt != 'Obsazeno' && $txt != 'Nedostupná') {
        $exists = true;
    }
}

if ($exists) {
    echo 'EXIST!'. PHP_EOL;
    $messaggio = 'New Exam place Exists!' .PHP_EOL . 'Go for it: https://cestina-pro-cizince.cz/trvaly-pobyt/a2/online-prihlaska/';

    foreach ($telegaChatIds as $telegaChatId) {
        $url = "https://api.telegram.org/bot" . $telegaToken . "/sendMessage?chat_id=" . $telegaChatId;
        $url = $url . "&parse_mode=html&text=" . urlencode(str_replace('<br/>',"\r\n", $messaggio));

        try {
            $ch = curl_init($url);
            $optArray = array(

            );
            curl_setopt_array($ch, $optArray);
            $result = curl_exec($ch);
            $errorNo = curl_errno($ch);
            $error = curl_error($ch);
            curl_close($ch);

        } catch (Exception $e) {

        }
    }
}

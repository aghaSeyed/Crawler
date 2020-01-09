<?php
require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();
$url_ipRotate = "http://api.scraperapi.com/?api_key=e9cc1887625ff2c4fdc0af583164bc65&url=";
$target_url = '';
$crawler = $client->request('GET', $url_ipRotate . $target_url, ['headers' => [
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36',
    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Connection' => 'keep-alive'
]]);


// for login:
$form = $crawler->selectButton('Login')->form();
$crawler = $client->submit($form, array('LoginForm[email]' => '', 'LoginForm[password]' => '', '_csrf' => 'uMzsdZaUUBTIyjp6A6DJ9xN0h-7-aBCuU7C3JxaXoFfV_okaxNwlQ6TzbQlzjfitVz-0m8oZScMYxYRoeK_XZQ=='));
$crawler->filter('.c-form__error')->each(function ($node) {
    print $node->text() . "\n";
});

// click on smth:
$link = $crawler->filter('li > a')->eq(10)->link();
//show the value of selector:
//print $crawler->filter('li > a')->eq(10)->text();
$crawler = $client->click($link);
//if selector has href instead of link() write attr("href") then :
//$crawler=$client->request('GET',$link);


//extract data and save to result.json :
$crawler = $client->request('GET', $url_ipRotate . 'https://spyse.com/search/subdomain?q=googlevideo.com', ['headers' => [
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36',
    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Connection' => 'keep-alive'
]]);
$crawler->filter('.classTarget')->each(function ($node) {
    print $node->text() . "\n";
    $txt = $node->text();
    $fp = fopen('results.json', 'a');
    fwrite($fp, json_encode($txt));
    fwrite($fp, "\n");
    fclose($fp);
});

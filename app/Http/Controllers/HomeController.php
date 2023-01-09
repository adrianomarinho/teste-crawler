<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Sunra\PhpSimple\HtmlDomParser;

class HomeController
{
    protected $url;
    protected $client;

    public function __construct()
    {
        $this->url = 'http://applicant-test.us-east-1.elasticbeanstalk.com/';

        $this->client = new Client([
            'cookies' => new CookieJar(),
            'headers' => [
                'Host' => 'applicant-test.us-east-1.elasticbeanstalk.com',
                'Origin' => 'http://applicant-test.us-east-1.elasticbeanstalk.com',
                'Referer' => 'http://applicant-test.us-east-1.elasticbeanstalk.com/'
            ]
        ]);
    }

    public function getAnswer()
    {
        $response = $this->client->get($this->url);
        $doc = new \DOMDocument();
        $doc->loadHTML($response->getBody()->getContents());

        $tokenElement = $doc->getElementById('token');
        $token = $tokenElement->getAttribute('value');

        $data = [
            'form_params' => [
                'token' => $this->replaceToken($token)
            ]
        ];

        $responsePost = $this->client->post($this->url, $data);

        $doc->loadHTML($responsePost->getBody()->getContents());
        return $doc->getElementById('answer')->textContent;
    }

    protected function getToken($stringBody)
    {
        echo (string)$stringBody;
        return HtmlDomParser::str_get_html($stringBody)->getElementById('token')->attr['value'];
    }

    protected function replaceToken($token)
    {
        $new_token = '';

        $replacements = [
        'a' => 'z',
        'b' => 'y',
        'c' => 'x',
        'd' => 'w',
        'e' => 'v',
        'f' => 'u',
        'g' => 't',
        'h' => 's',
        'i' => 'r',
        'j' => 'q',
        'k' => 'p',
        'l' => 'o',
        'm' => 'n',
        'n' => 'm',
        'o' => 'l',
        'p' => 'k',
        'q' => 'j',
        'r' => 'i',
        's' => 'h',
        't' => 'g',
        'u' => 'f',
        'v' => 'e',
        'w' => 'd',
        'x' => 'c',
        'y' => 'b',
        'z' => 'a',
        '0' => '9',
        '1' => '8',
        '2' => '7',
        '3' => '6',
        '4' => '5',
        '5' => '4',
        '6' => '3',
        '7' => '2',
        '8' => '1',
        '9' => '0'
    ];

        for ($i = 0; $i < strlen($token); $i++) {
            $new_token .= (in_array($token[$i], $replacements) ? $replacements[$token[$i]] : $token[$i]);
        }

        return $new_token;
    }
}

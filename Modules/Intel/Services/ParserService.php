<?php

namespace Modules\Intel\Services;


class ParserService {

    public function curlGetPage($url, $referer = 'https://google.com/'): bool|string
    {
        set_time_limit(3600);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, '');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;

    }
}


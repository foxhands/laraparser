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

    public function getUrlStatus($url)
    {
        // Создаём дескриптор cURL
        $ch = curl_init($url);

        if($ch === false)
            return false;

        curl_setopt($ch, CURLOPT_HEADER         ,true);    // we want headers
        curl_setopt($ch, CURLOPT_NOBODY         ,true);    // don't need body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);    // catch output (do NOT print!)

        curl_exec($ch);

        if(curl_errno($ch)){   // should be 0
            curl_close($ch);
            return false;
        }

        return curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }
}


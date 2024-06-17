<?php

namespace App\Helpers;

if (!function_exists('getQuoteFromVnDb')) {
    /** @noinspection PhpComposerExtensionStubsInspection */
    function getQuoteFromVnDb(): array
    {
        $ret = [
            "ok" => false,
            "data" => null,
            "error" => null,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://vndb.org/d5.1");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36'
        ]);
        $raw = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        if (isset($error_msg)) {
            $ret['error'] = $error_msg;
        } else {
            $matches = array();
            $regex = "/<footer><span>\"<a href=\"\/v(\d+)\">(.*?)<\/a>&quot;/";
            preg_match_all($regex, $raw, $matches);
            if (count($matches) == 3) {
                $ret['ok'] = true;
                $ret['data'] = [
                    "vn_id" => $matches[1][0],
                    "quote" => htmlspecialchars_decode($matches[2][0]),
                ];
            } else {
                $ret['ok'] = false;
                $ret['error'] = "Failed to get Quote.";
            }

        }
        curl_close($ch);
//        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
//        echo PHP_EOL;
        return $ret;
    }
}

<?php

namespace App\Helpers;


class KgSms
{
    private static $apiUrl = "https://kgit.in/api/sms/send";
    private static $apikey = "aX5LHUxkLpxccryZZyTGcgS4C2EuMb3h";
    private static $curl;
    

    /**
     * initialize persistent cURL (keep connection alive)
     */
    private static function initCurl()
    {
        if (!self::$curl) {
            self::$curl = curl_init();
            curl_setopt(self::$curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(self::$curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt(self::$curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt(self::$curl, CURLOPT_TIMEOUT, 10);

            // 🚀 keep TCP connection open between multiple requests
            curl_setopt(self::$curl, CURLOPT_FORBID_REUSE, false);
            curl_setopt(self::$curl, CURLOPT_FRESH_CONNECT, false);
        }
    }

    /**
     * FAST single SMS send
     */
    public static function send($mobile, $message, $channel = null, $file = null)
    {
        self::initCurl();
    
        $params = [
            'channel'        => $channel ?? self::$apikey,
            'mobile_numbers' => $mobile,
            'message'        => $message,
            'country_code'   => '',
            'attachment'     => $file
        ];
    
        $url = self::$apiUrl . '?' . http_build_query($params);
        curl_setopt(self::$curl, CURLOPT_URL, $url);
    
        $responseRaw = curl_exec(self::$curl);
        $response = self::formatResponse($responseRaw);
    
    
        return $response;
    }

    /**
     * FAST bulk SMS send (1000+ numbers without slow down)
     */
    public static function sendBulk($partyList, $template, $channel = null, $file = null)
    {
        $results = [];

        foreach ($partyList as $party) {
            
            if(!empty($file)){
                $attachment = $file;
            }elseif (!empty($party['attachment'])) {
                $attachment = $party['attachment'];
            }else{
                $attachment = null;
            }

            $msg = self::template($template, $party);

            $params = [
                'channel'         => $channel ?? self::$apikey,
                'mobile_numbers'  => $party['mobile'],
                'message'         => $msg,
                'country_code'    => '',
                'attachment'      => $attachment
            ];

            $url = self::$apiUrl . '?' . http_build_query($params);

            self::initCurl();
            curl_setopt(self::$curl, CURLOPT_URL, $url);

            $responseRaw = curl_exec(self::$curl);

            $results[] = [
                'mobile'   => $party['mobile'],
                'message'  => $msg,
                'response' => self::formatResponse($responseRaw)
            ];
            
            sleep(rand(2,5));
        }

        return $results;
    }

    /**
     * response formatter
     */
    private static function formatResponse($responseRaw)
    {
        $json = json_decode($responseRaw, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return [
                'success' => $json['success'] ?? false,
                'message' => $json['message'] ?? '',
                'raw'     => $responseRaw
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid JSON',
            'raw'     => $responseRaw
        ];
    }

    /**
     * Replace {{key}} tags with values
     */
    private static function template($tpl, $data)
    {
        foreach ($data as $key => $val) {
            $tpl = str_replace('{{'.$key.'}}', $val, $tpl);
        }
            // Timestamp
        $timestamp = date("d-m-Y h:i A"); // Example: 01-12-2025 03:40 PM
    
        // Add newline + timestamp at end
        return $tpl . "\n\n-- Sent on: " . $timestamp;
    }

    /**
     * close persistent curl connection (optional)
     */
    public static function close()
    {
        if (self::$curl) curl_close(self::$curl);
        self::$curl = null;
    }
}
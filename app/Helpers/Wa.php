<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class Wa
{
  public static function send($nohp, $pesan)
  {
    $url = config('dripsender.url');
    $api_key = config('dripsender.apikey');

    //Initiate cURL.
    $ch = curl_init($url);

    //The JSON data.
    $jsonData = array(
      'api_key' => $api_key,
      'phone' => preg_replace('/^[0]/', '62', $nohp),
      'text' => $pesan
    );

    //Encode the array into JSON.
    $jsonDataEncoded = json_encode($jsonData);

    // log
    Log::debug($jsonDataEncoded);

    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);

    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //Execute the request
    $result = curl_exec($ch);

    return $result;
  }
}

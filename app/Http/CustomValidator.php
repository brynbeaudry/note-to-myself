<?php

namespace App\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use App\User;

class CustomValidator {

    /*Reutrns true or false*/
    public function custom_captcha($attribute, $value, $parameters, $validator)
    {
      $response = array();
      $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/',
            'timeout' => 2.0
            ]);

      $promise = $client->requestAsync('POST', 'siteverify',  [
            'query' => [
            'secret' => '6LdoLRwUAAAAAGA92tU0yCvexmjZW06cAvwT2dWf',
            'response' => $value]
            ]
        );
      $promise->then(
        function (ResponseInterface $res) {
            //echo 'Got a response! ' . $res->getStatusCode();
            //dd($response);
          },
          function (RequestException $e) {
              echo $e->getMessage() . "\n";
              echo $e->getRequest()->getMethod();
          }
      );
      //dd($response);
      $response = $promise->wait()->getBody()->getContents();
      $response = json_decode($response, true);
      if($response['success']){
        return true;
      }else{
        return false;
      }
    }
  }

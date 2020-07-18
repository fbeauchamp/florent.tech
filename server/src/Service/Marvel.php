<?php

namespace App\Service;

use DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;
 // public key ad0a205e96abfc2940bb9dc1bdf796dd
 //private f8c873e2322d7e9f9415e1d69ed38ecd347ef321
class Marvel
{

  private $client;
  private $baseUrl ='https://gateway.marvel.com:443/v1/public/';

  public function __construct(HttpClientInterface $client)
  {
      $this->client = $client;
  }

  private function makeQuery($endpoint, $parameters=[])
  {
    $publicKey = $_ENV['MARVEL_PUBLIC_KEY'];
    $privateKey = $_ENV['MARVEL_PRIVATE_KEY'];
    $ts = (new DateTime())->getTimeStamp();
    $hash = md5($ts.$privateKey.$publicKey);
    $copy = array_slice($parameters, 0, count($parameters));
    $copy['apikey'] = $publicKey;
    $copy['ts'] = $ts;
    $copy['hash'] = $hash;

    $response = $this->client->request('GET', $this->baseUrl . $endpoint,
    ['query'=>$copy
    ]);
    
    $content = $response->getContent();
    return json_decode($content);
  }

  public function fetchSeries()
  {
    return $this->makeQuery('series');
  }
  public function fetchSerie($id)
  {
    return $this->makeQuery('series/'.$id);
  }
}

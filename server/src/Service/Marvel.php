<?php

namespace App\Service;

use DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Cache;

class Marvel
{

  private $client;
  private $entityManager;
  private $baseUrl ='https://gateway.marvel.com:443/v1/public/';

  public function __construct(HttpClientInterface $client, EntityManagerInterface $entityManager)
  {
    $this->client = $client;
    $this->entityManager = $entityManager;
  }

  private function makeQuery(string $endpoint, string $cacheId=null,array $parameters=[]):string
  {
    if($cacheId){
      $cachedContent = $this->entityManager
      ->getRepository(Cache::class)
      ->find($cacheId);
      if($cachedContent){
        return $cachedContent->getData();
      }
    }
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
    if($cacheId){
      $cached = new Cache();
      $cached->setId($cacheId);
      $cached->setData($content);
      $cached->setCreatedAt(null);
      
      $this->entityManager->persist($cached);
      $this->entityManager->flush();
    }
    return $content;
  }

  public function fetchSeries(array $parameters=[])
  {
    return $this->makeQuery('series', null, $parameters);
  }
  public function fetchSerie(string $id)
  {
    return $this->makeQuery('series/'.$id, 'series/'.$id);
  }

  public function fetchSerieComics(string $id,array $parameters)
  {
    return $this->makeQuery('series/'.$id.'/comics', null, $parameters);
  }
  
  public function fetchCharacter(string $id)
  {
    return $this->makeQuery('characters/'.$id,'character/'.$id);
  }
}

<?php
 namespace App\Controller;
 
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\Routing\Annotation\Route;

 use App\Service\Marvel;
 use App\Entity\Cache;
use DateTime;

class MarvelController extends AbstractController
 {
  /**
   * @Route("/marvel/series", methods={"GET","HEAD"})
   */
  public function series(Marvel $marvel)
  {
     return $this->json(
      json_decode($marvel->fetchSeries())
     );
   }
   /**
    * @Route("/marvel/serie/{id}", methods={"GET","HEAD"})
    */
  public function serie(string $id, Marvel $marvel)
  {
     
    $serie = $this->getDoctrine()
      ->getRepository(Cache::class)
      ->find('serie'.$id);
    if($serie){
      return $this->json(json_decode($serie->getData()));
    }
    $serie = $marvel->fetchSerie($id);
    
    $entityManager = $this->getDoctrine()->getManager();
    $cached = new Cache();
    $cached->setId('serie'.$id);
    $cached->setData($serie);
    $cached->setCreatedAt(null);
    
    $entityManager->persist($cached);
    $entityManager->flush();

    return $this->json(
      json_decode($serie)
    );
  }

  public function character(string $id, Marvel $marvel){
      
    
    $character = $this->getDoctrine()
      ->getRepository(Cache::class)
      ->find('character'.$id);
    if($character){
      return $this->json(json_decode($character->getData()));
    }
    $character = $marvel->fetchCharacter($id);
    
    $entityManager = $this->getDoctrine()->getManager();
    $cached = new Cache();
    $cached->setId('serie'.$id);
    $cached->setData($character);
    $cached->setCreatedAt(null);
    
    $entityManager->persist($cached);
    $entityManager->flush();

    return $this->json(
      json_decode($character)
    );
  }
 }
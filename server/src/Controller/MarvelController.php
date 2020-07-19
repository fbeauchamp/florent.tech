<?php
 namespace App\Controller;
 
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\Routing\Annotation\Route;

 use App\Service\Marvel;

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
    $serie = $marvel->fetchSerie($id);
    return $this->json(
      json_decode($serie)
    );
  }

   /**
    * @Route("/marvel/character/{id}", methods={"GET","HEAD"})
    */
  public function character(string $id, Marvel $marvel){
    $character = $marvel->fetchCharacter($id);
    return $this->json(
      json_decode($character)
    );
  }
 }
<?php
 namespace App\Controller;
 
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\HttpFoundation\Request;


 use App\Service\Marvel;

class MarvelController extends AbstractController
 {
  /**
   * @Route("/marvel/series", methods={"GET","HEAD"})
   */
  public function series(Request $request, Marvel $marvel)
  {
     return $this->json(
      json_decode($marvel->fetchSeries($request->query->all()))
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
    * @Route("/marvel/serie/{id}/comics", methods={"GET","HEAD"})
    */
    public function serieComics(Request $request, string $id, Marvel $marvel)
    {
      $serie = $marvel->fetchSerieComics($id, $request->query->all());
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
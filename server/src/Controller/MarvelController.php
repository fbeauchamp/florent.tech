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
       $marvel->fetchSeries()
     );
   }
   /**
    * @Route("/marvel/serie/{id}", methods={"GET","HEAD"})
    */
   public function serie(string $id, Marvel $marvel)
   {
      return $this->json(
        $marvel->fetchSerie($id)
      );
    }
 }
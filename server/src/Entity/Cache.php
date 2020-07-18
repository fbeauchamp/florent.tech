<?php 
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CacheRepository")
 */
class Cache
{
    /**
     * @var string
     * 
     * @ORM\Id
     * @ORM\Column(type="string", unique=true)
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="datetime", name="createdAt", nullable=true) 
     * */
    private $createdAt;

    /**
     * @ORM\Column(type="text", name="data") */
    private $data;

    public function getId(){
      return $this->id;
    }
    public function setId($id){
      $this->id = $id;
    }
    public function getCreatedAt(){
      return $this->createdAt;
    }
    public function setCreatedAt($createdAt){
      $this->createdAt = $createdAt;
    }
    public function getData(){
      return $this->data;
    }
    public function setData($data){
      $this->data = $data;
    }
}
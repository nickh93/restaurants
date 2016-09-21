<?php
/**
 *
 */
class Restaurant
{
  private $id;
  private $name;
  private $cuisine_id;


    function __construct($restaurant_id = null, $restaurant_name, $cui_id = null)
    {
        $this->id = $restaurant_id;
        $this->name = $restaurant_name;
        $this->cuisine_id = $cui_id;
    }

    function getId()
    {
      return $this->id;
    }

   function setName($restaurant_name)
    {
     $this->name = $restaurant_name;
    }

   function getName()
    {
     return $this->name;
   }

    function getCuisineId()
    {
     return $this->cuisine_id;
    }

  }






 ?>

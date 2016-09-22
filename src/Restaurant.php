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

      static function getAll()
      {
         $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM Restaurants;");
         $restaurants = array();
            foreach ($returned_restaurants as $restaurant)
            {
                $id = $restaurant['restaurant_id'];
                $name = $restaurant['name'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant = new Restaurant($id, $name, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
          return $restaurants;
      }

      function save()
      {
         $GLOBALS['DB']->exec("INSERT INTO Restaurants(name, cuisine_id) VALUES ('{$this->getName()}', {$this->getCuisineId()});");
         $this->id = $GLOBALS['DB']->lastInsertId();

      }

      static function find($search_id)
      {
          $found_restaurant = null;
          $restaurants = Restaurant::getAll();
          foreach($restaurants as $restaurant)
          {
              $restaurant_id = $restaurant->getId();
              if ($restaurant_id == $search_id)
              {
                  $found_restaurant = $restaurant;
              }
          }
          return $found_restaurant;
      }
      static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE FROM Restaurants;");
      }

  }


 ?>

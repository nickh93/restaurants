<?php

/**
 *
 */
class Cuisine
{
    private $name;
    private $cuisine_id;

    function __construct($cuisine_name, $cui_id = null)
        {
          $this->name = $cuisine_name;
          $this->cuisine_id = $cui_id;
        }


    function getId()
        {
          return $this->cuisine_id;
        }

    function setName($cuisine_name)
        {
          $this->name = $cuisine_name;
        }

    function getName()
        {
          return $this->name;
        }

    static function getAll()
        {
        $returned_Cuisines = $GLOBALS['DB']->query("SELECT * FROM Cuisine;");
        $cuisines = array();
        foreach ($returned_Cuisines as $cuisine)
            {
              $cuisine_id = $cuisine['cuisine_id'];
              $name = $cuisine['name'];
              $new_cuisine = new Cuisine($name, $cuisine_id);
              array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }
      function save()
      {
          $GLOBALS['DB']->exec("INSERT INTO Cuisine (name) VALUES ('{$this->getName()}');");
          $this->cuisine_id = $GLOBALS['DB']->lastInsertId();
      }

      static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE from Cuisine");
      }






}





 ?>

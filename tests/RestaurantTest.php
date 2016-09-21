<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
 require_once "src/Restaurant.php";
 require_once "src/Cuisine.php";


 $server = 'mysql:host=localhost:8889;dbname=best_restaurants_test';
 $username = 'root';
 $password = 'root';
 $DB = new PDO($server, $username, $password);

 class RestaurantTest extends PHPUnit_Framework_TestCase
   {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getName()
        {
            //ARRANGE
            $name = "McDrugs";
            $id = null;
            $test_cuisine = new Restaurant($id, $name);
            //ACT
            $result = $test_cuisine->getName();
            //ASSERT
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //ARRANGE
            $name = "McDrugs";
            $id = 1;
            $test_cuisine = new Restaurant($id, $name);
            //ACT
            $result = $test_cuisine->getId();
            //ASSERT
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //ARRANGE
            $cuisine_name = "Chinese";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_name, $id);
            $test_cuisine->save();

            $name = "McDrugs";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $name, $cuisine_id);

            //ACT
            $test_restaurant->save();
            $result = Restaurant::getAll();

            //ASSERT
            $this->assertEquals($test_restaurant, $result[0]);

        }
        function test_getAll()
        {
            //ARRANGE
            $cuisine_name = "Chinese";
            $id = null;
            $test_cuisine = new Cuisine($cuisine_name, $id);
            $test_cuisine->save();

            $restaurant_name = "McDrugs";
            $restaurant_name2 = "Rosarios";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant2 = new Restaurant($id, $restaurant_name2, $cuisine_id);
            $test_restaurant->save();
            $test_restaurant2->save();

            //ACT
            $result = Restaurant::getAll();

            //ASSERT
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);


        }




 }




 ?>

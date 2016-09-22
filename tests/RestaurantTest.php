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

        function test_getId()
        {
            //ARRANGE
            $cuisine_name = "Chinese";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $restaurant_id = 1;
            $restaurant_name = "McDrugs";
            $test_restaurant = new Restaurant($restaurant_id, $restaurant_name, $cuisine_id);

            //ACT
            $result = $test_restaurant->getId();
            //ASSERT
            $this->assertEquals($restaurant_id, $result);
            //make sure id returned is the one we put in, not null.
        }
        function test_getName()
        {
            //ARRANGE
            $cuisine_name = "Chinese";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();
            //there is no need to pass in id because it IS NULL by default

            $restaurant_id = null;
            $restaurant_name = "McDrugs";
            $test_restaurant = new Restaurant($restaurant_id, $restaurant_name, $cuisine_id);
            //ACT
            $result = $test_restaurant->getName();
            //ASSERT
            // id is null in this case, but that is not what we are testing. We are only interested in the description.
            $this->assertEquals($restaurant_name, $result);
        }
        function test_setName()
        {
            //ARRANGE
            $cuisine_name = "Chinese";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();
            $cuisine_id = $test_cuisine->getId();

            $restaurant_id = null;
            $restaurant_name = "McDrugs";
            $test_restaurant = new Restaurant($restaurant_id, $restaurant_name, $cuisine_id);
            $new_restaurant_name = "Rosarios";

            //ACT
            $test_restaurant->setName($new_restaurant_name);
            $result = $test_restaurant->getName();
            //ASSERT
            $this->assertEquals($new_restaurant_name, $result);
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

        function test_find()
        {
            //ARRANGE
            // create more than one task so that we can be sure we can locate the one we are interested in.
            $restaurant_name = "McDrugs";
            $id = null;
            $restaurant_name2 = "Rosarios";
            $cuisine_id = 1;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save(); // id is assigned to name by database
            $test_restaurant2 = new Restaurant($id, $restaurant_name2, $cuisine_id);
            $test_restaurant2->save();

            //ACT
            // find a task bu using the id assigned during the save method.
            $result = Restaurant::find($test_restaurant->getId());

            //ASSERT
            // we are now gonna make sure we found the one we wete looking for
            $this->assertEquals($test_restaurant, $result);
        }

 }




 ?>

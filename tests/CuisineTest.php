<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getName()
        {
            //ARRANGE
            $name = "Chinese";
            $test_cuisine = new Cuisine($name);
            //ACT
            $result = $test_cuisine->getName();
            //ASSERT
            $this->assertEquals($name, $result);
        }
        function test_getId()
        {
            //ARRANGE
            $name = "Chinese";
            $id = 1;
            $test_cuisine = new Cuisine($name, $id);
            //ACT
            $result = $test_cuisine->getId();
            //ASSERT
            $this->assertEquals(true, is_numeric($result));
        }
        function test_save()
        {
            //ARRANGE
            $name = "Chinese";
            $cuisine_id = null;
            $test_cuisine = new Cuisine($name, $cuisine_id);
            $test_cuisine->save();
            //ACT
            $result = $test_cuisine->getAll();
            //ASSERT
            $this->assertEquals($test_cuisine, $result[0]);
        }
        function test_getAll()
        {
          //ARRANGE
          $name = "Chinese";
          $name1_id = null;
          $name2_id = null;
          $name2 = "Colombiana";
          $test_cuisine = new Cuisine($name, $name1_id);
          $test_cuisine->save();
          $test_cuisine2 = new Cuisine($name2,$name2_id);
          $test_cuisine2->save();

          //ACT
          $result = Cuisine::getAll();
          //ASSERT
          $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }
        function test_find()
        {
            //ARRANGE
            // create more than one task so that we can be sure we can locate the one we are interested in.
            $cuisine_name = "Chinese";
            $id = 1;
            $cuisine_name2 = "Colombiana";
            $test_cuisine = new Cuisine($id, $cuisine_name);
            $test_cuisine->save(); // id is assigned to name by database
            $test_cuisine2 = new Cuisine($id, $cuisine_name2);
            $test_cuisine2->save();

            //ACT
            // find a task bu using the id assigned during the save method.
            $result = Cuisine::find($test_cuisine->getId());

            //ASSERT
            // we are now gonna make sure we found the one we wete looking for
            $this->assertEquals($test_cuisine, $result);
        }
    }
?>

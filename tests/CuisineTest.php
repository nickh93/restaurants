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
        }

        function test_getName()
        {
            //ARRANGE
            $name = "Chinese"
            $test_cuisine = new Cuisine($name);
            //ACT
            $result = $test_cuisine->getName
            //ASSERT
            $this->assertEquals($name, $result);
        }
    }
?>

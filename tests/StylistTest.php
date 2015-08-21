<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown() {
        //     Stylist::deleteAll();
        //
        // }

        function test_getName()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $test_stylist = new Stylist($name, $phone);

            $result = $test_stylist->getName();

            $this->assertEquals($name, $result);
        }





    }

?>

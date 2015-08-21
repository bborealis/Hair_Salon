<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Client::deleteAll();
        //
        // }

        function test_getName()
        {
            $name = "Maggie";
            $phone = "123-321-1234";
            $id = null;
            $stylist_id = 4;
            $test_client = new Client($name, $phone, $id, $stylist_id);

            $result = $test_client->getName();

            $this->assertEquals($name, $result);
        }

        function test_getPhone()
        {
            $name = "Maggie";
            $phone = "123-321-1234";
            $id = null;
            $stylist_id = 4;
            $test_client = new Client($name, $phone, $id, $stylist_id);

            $result = $test_client->getPhone();

            $this->assertEquals($phone, $result);
        }

        function test_getId()
        {
            $name = "Maggie";
            $phone = "123-321-1234";
            $id = null;
            $stylist_id = 4;
            $test_client = new Client($name, $phone, $id, $stylist_id);
            $test_client->save();

            $result = $test_client->getId();

            $this->assertEquals(true, is_numeric($result));
        }





    }
?>

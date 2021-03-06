<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();

        }

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

        function test_getStylistId()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();

            $name = "Maggie";
            $phone = "123-321-1234";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $id, $stylist_id);
            $test_client->save();

            $result = $test_client->getStylistId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getAll()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();

            $name = "Maggie";
            $phone = "123-321-1234";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $id, $stylist_id);
            $test_client->save();

            $name2 = "Steve";
            $phone2 = "999-777-6666";
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name2, $phone2, $id, $stylist_id2);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();

            $name = "Maggie";
            $phone = "123-321-1234";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $id, $stylist_id);
            $test_client->save();

            $name2 = "Steve";
            $phone2 = "999-777-6666";
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name2, $phone2, $id, $stylist_id2);
            $test_client2->save();

            Client::deleteAll();
            $result = Client::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();

            $name = "Maggie";
            $phone = "123-321-1234";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $id, $stylist_id);
            $test_client->save();

            $name2 = "Steve";
            $phone2 = "999-777-6666";
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name2, $phone2, $id, $stylist_id2);
            $test_client2->save();

            $result = Client::find($test_client->getId());

            $this->assertEquals($test_client, $result);
        }

        function test_update()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();

            $name = "Maggie";
            $phone = "123-321-1234";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $id, $stylist_id);
            $test_client->save();

            $new_name = "George";
            $new_phone = "123-456-7890";

            $test_client->update($new_name, $new_phone);

            $this->assertEquals("George", $test_client->getName());
            $this->assertEquals("123-456-7890", $test_client->getPhone());

        }

        function test_delete()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();

            $name = "Maggie";
            $phone = "123-321-1234";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $id, $stylist_id);
            $test_client->save();

            $name2 = "Steve";
            $phone2 = "999-777-6666";
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name2, $phone2, $id, $stylist_id2);
            $test_client2->save();

            $test_client->delete();

            $this->assertEquals([$test_client2], Client::getAll());
        }







    }
?>

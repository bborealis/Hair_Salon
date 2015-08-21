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
        protected function tearDown() {
            Stylist::deleteAll();
            Client::deleteAll();

        }

        function test_getName()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $test_stylist = new Stylist($name, $phone);

            $result = $test_stylist->getName();

            $this->assertEquals($name, $result);
        }

        function test_getPhone()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $test_stylist = new Stylist($name, $phone);

            $result = $test_stylist->getPhone();

            $this->assertEquals($phone, $result);
        }

        function test_save()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();
            $result = Stylist::getAll();
            $this->assertEquals($test_stylist,  $result[0]);
        }

        function test_deleteAll()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();
            $name2 = "Judy";
            $test_stylist2 = new Stylist($name2, $phone, $id);
            $test_stylist2->save();

            Stylist::deleteAll();
            $result = Stylist::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $test_stylist = new Stylist($name, $phone);
            $test_stylist->save();
            $name2 = "Judy";
            $test_stylist2 = new Stylist($name2, $phone);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals($test_stylist, $result);
        }

        function test_update()
        {
            $name = "Sally";
            $phone = "555-555-5555";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);
            $test_stylist->save();

            $new_name = "Stella";
            $new_phone = "503-222-4445";

            $test_stylist->update($new_name, $new_phone);

            $this->assertEquals("Stella", $test_stylist->getName());
            $this->assertEquals("503-222-4445", $test_stylist->getPhone());
        }

        function test_delete()
         {
             $name = "Sally";
             $phone = "555-555-5555";
             $id = null;
             $test_stylist = new Stylist($name, $phone, $id);
             $test_stylist->save();
             $name2 = "Judy";
             $test_stylist2 = new Stylist($name2, $phone, $id);
             $test_stylist2->save();

             $test_stylist->delete();

             $this->assertEquals([$test_stylist2], Stylist::getAll());
         }






    }

?>

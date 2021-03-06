<?php
    class Stylist
    {
        private $name;
        private $phone;
        private $id;

        function __construct($name, $phone, $id = null)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $phone = $client['phone'];
                $id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($name, $phone, $id, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name, phone) VALUES ('{$this->getName()}', '{$this->getPhone()}');");
            $result_id = $GLOBALS['DB']->lastInsertId();
            $this->setId($result_id);
        }

        function update($new_name, $new_phone)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}', phone = '{$new_phone}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $this->setPhone($new_phone);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $phone = $stylist['phone'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $phone, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id) {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }









    }
?>

<?php
    class Client
    {
        private $name;
        private $phone;
        private $id;
        private $client_id;

        function __construct($name, $phone, $id = null, $stylist_id)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->id = $id;
            $this->stylist_id = $stylist_id;
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

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, phone, stylist_id) VALUES ('{$this->getName()}', '{$this->getPhone()}', {$this->getStylistId()});");
            $result_id = $GLOBALS['DB']->lastInsertId();
            $this->setId($result_id);
        }


    }
?>

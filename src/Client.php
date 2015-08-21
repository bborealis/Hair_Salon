<?php
    class Client
    {
        private $name;
        private $phone;
        private $id;
        private $client_id;

        function __construct($name, $phone, $id = null, $client_id)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->id = $id;
            $this->client_id = $client_id;
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

        function getClientId()
        {
            return $this->client_id;
        }


    }
?>

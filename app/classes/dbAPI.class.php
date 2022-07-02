<?php
require_once "API.class.php";

class Database
{
    public function __construct()
    {
        $this->baseUrl = "https://csms-api-env.herokuapp.com/api/index.php/";
        $this->baseHeader = "Content-Type: application/json";
    }

    public function getAllUser()
    {
        return API::request(
            $this->baseUrl . 'user/list',
            "HEADER",
            $this->baseHeader
        );
    }

    public function findUserByUsername($username)
    {
        return API::request(
            $this->baseUrl . 'user/find?username=' . $username,
            "HEADER",
            $this->baseHeader
        );
    }
}
?>
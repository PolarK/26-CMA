<?php
require_once "API.class.php";

class Database
{
    public function __construct()
    {
        $this->baseUrl = "https://csms-api-env.herokuapp.com/api/index.php/";
        $this->baseHeader = 'Content-Type: application/json; charset=UTF-8';
    }

    public function getAllUser()
    {
        return API::request(
            $this->baseUrl . 'user/list',
            "HEADER",
            $this->baseHeader
        );
    }

    public function findUserById($id)
    {
        return API::request(
            $this->baseUrl . 'user/findUserById?id=%' . $id . '%',
            "HEADER",
            $this->baseHeader
        );
    }
}
?>
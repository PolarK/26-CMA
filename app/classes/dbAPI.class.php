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
            "GET_REQUEST",
            $this->baseHeader
        );
    }

    public function findUserById($id)
    {
        return API::request(
            $this->baseUrl . 'user/findUserById?id=' . $id ,
            "GET_REQUEST",
            $this->baseHeader
        );
    }

    public function createNewUser()
    {
        extract(func_get_args(), EXTR_PREFIX_ALL, "arg");
        $fields = [
            'UserId' => $arg_0,
            'UserFirstName' => $arg_1,
            'UserLastName' => $arg_2,
            'UserDOB' => $arg_3,
            'UserEmail' => $arg_4,
            'UserPhoneNo' => $arg_5,
            'UserRole' => $arg_6
        ];

        return API::request(
            $this->baseUrl . 'user/createUser',
            "POST_REQUEST",
            $fields
        );
    }
}
?>
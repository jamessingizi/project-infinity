<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 17/11/2016
 * Time: 20:54
 */

class Admin {
    /**
     * @var id
     * a unique identifier of the admin user
     */
    public $id;

    /**
     * @var email
     * admin email for login purposes
     */
    public $email;
    /**
     * @var password
     * the admin encrypted password for login
     */
    public $password;

    /**
     * @var status
     * 1 for logged in and 0 for logged out
     */
    public $status;

    /**
     * @var createdOn
     * the time at which the account was created
     */
    public $createdOn;

    /**
     * @var lastModified
     * the last account modification timestamp
     */
    public $lastModified;

    /**
     * @var lastLogin
     * the last login time for the admin
     */
    public $lastLogin;

    /**
     * @var logins
     * number of logins since the account was created
     */
    public $logins;

    /**
     * @return NULL
     * sets the status to 1 once the administrator is logged in
     */
    public function login(){

        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $email = $sqlCon->escape_string($this->email);

        $query = "UPDATE  admin SET status = 1,last_login = $this->lastLogin WHERE email = '$email'";

        $result = $sqlCon->query($query);

        return $result;

    }

    /**
     * @return mixed an array of admin details
     */
    public function getDetails(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $email = $sqlCon->escape_string($this->email);

        $query = "SELECT * FROM admin WHERE email = '$email'";

        $result = $sqlCon->query($query);

        return $result->fetch_assoc();

    }

    /**
     * @return null
     * sets status to zero for the user so that the user is effectively logged out
     */
    public function logout(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $email = $sqlCon->escape_string($this->email);

        $query = "UPDATE  admin SET status = 0 WHERE email = '$email'";

        $result = $sqlCon->query($query);

        return $result;
    }



}
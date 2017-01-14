<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 19/11/2016
 * Time: 22:07
 */

class User {

    /**
     * @var $id a unique identifier for the user. it is the primary key
     */
    public $id;
    /**
     * @var $firstName users' first name
     */
    public $firstName;

    /**
     * @var lastName users' last name
     */
    public $lastName;
    /**
     * @var $email user email for logging in, should be unique
     */
    public $email;
    /**
     * @var $password for logging in
     */
    public $password;

    /**
     * @var $cell users' cell number
     */
    public $cell;
    /**
     * @var $accountStatus 0 for inactive account and 1 for active account, login should consider this fact
     */
    public $accountStatus;

     /** @var $country
     */
    public $country;
    /**
     * @var $city users' city location
     */
    public $city;
    /**
     * @var $created date for account created, timestamp
     */
    public $created;
    /**
    /**
     * @var $lastAccessed timestamp for last access time
     */
    public $lastAccessed;

    /**
     * @return array an array containing user details, im using this for login
     */
    public function getDetails(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $email = $sqlCon->escape_string($this->email);

        $query = "SELECT * FROM accounts WHERE email = '$email'";

        $result = $sqlCon->query($query);

        return $result->fetch_assoc();

    }

    public static function getAccountInfo($id){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($id);

        $query = "SELECT * FROM accounts WHERE id = '$id'";

        $result = $sqlCon->query($query);

        return $result->fetch_assoc();

    }

    /**
     * @return boolean sets status to 0 to deactivate account
     */
    public function deactivate(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $email = $sqlCon->escape_string($this->email);

        $query = "UPDATE accounts SET account_status = 0 WHERE email = '$email'";

        $result = $sqlCon->query($query);

        return $result;
    }

    /**
     * @return boolean sets status to 1 to activate account
     */
    public function activate(){

        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $email = $sqlCon->escape_string($this->email);

        $query = "UPDATE accounts SET account_status = 1 WHERE email = '$email'";

        $result = $sqlCon->query($query);

        return $result;

    }

    public function addAccount(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($this->id);
        $email = $sqlCon->escape_string($this->email);
        $password = $sqlCon->escape_string($this->password);
        $firstName = $sqlCon->escape_string($this->firstName);
        $lastName = $sqlCon->escape_string($this->lastName);
        $cell = $sqlCon->escape_string($this->cell);
        $accountStatus = $sqlCon->escape_string($this->accountStatus);
        $created = $sqlCon->escape_string($this->created);
        $lastAccessed = $sqlCon->escape_string($this->lastAccessed);
        $country = $sqlCon->escape_string($this->country);
        $city = $sqlCon->escape_string($this->city);

        $query = "INSERT INTO accounts(id,firstname,lastname,email,password,cell,country,city,account_status,created,last_accessed)";
        $query.="VALUES('$id','$firstName','$lastName','$email','$password','$cell','$country','$city',$accountStatus,$created,$lastAccessed)";

        $result = $sqlCon->query($query);

        return $result;

    }

        public function updateAccount(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($this->id);
        $firstName = $sqlCon->escape_string($this->firstName);
        $lastName = $sqlCon->escape_string($this->lastName);
        $cell = $sqlCon->escape_string($this->cell);
        $country = $sqlCon->escape_string($this->country);
        $city = $sqlCon->escape_string($this->city);

        $query = "UPDATE accounts SET firstname='$firstName', lastname = '$lastName', cell = '$cell', country = '$country', city = '$city' WHERE id = '$id'";

        $result = $sqlCon->query($query);

        return $result;

    }

    public static function updatePassword($password,$userId){

        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $password = $sqlCon->escape_string($password);
        $userId = $sqlCon->escape_string($userId);

        $query = "UPDATE accounts SET password = '$password' WHERE id = '$userId'";

        $result = $sqlCon->query($query);

        return $result;

    }

    public function checkExistence(){

        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $email = $sqlCon->escape_string($this->email);

        $query = "SELECT COUNT(*) FROM accounts WHERE email = '$email'";

        $result = $sqlCon->query($query);

        $output = $result->fetch_assoc();

        return array_shift($output);

    }

}
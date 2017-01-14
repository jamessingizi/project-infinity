<?php 

/**
* userbio  this class contains information about user bio and image
*/
class Userbio{
	
	public $id;
	public $userId;
	public $bio;
	public $image;

	public function add(){
		$dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $userId = $sqlCon->escape_string($this->userId);
        $bio = $sqlCon->escape_string($this->bio);
        $image = $sqlCon->escape_string($this->image);

        $query = "INSERT INTO userbio(id,userid,bio,image) VALUES(NULL,'$userId','$bio','$image')";

        $result = $sqlCon->query($query);

        return $result;
	}

	public function update(){
		$dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $userId = $sqlCon->escape_string($this->userId);
        $bio = $sqlCon->escape_string($this->bio);

        $query = "UPDATE userbio SET bio = '$bio' WHERE userid = '$userId'";

        $result = $sqlCon->query($query);

        return $result;
	}

	public static function getBio($userId){

		$dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $userId = $sqlCon->escape_string($userId);

        $query = "SELECT * FROM userbio WHERE userid = '$userId'";

        $result = $sqlCon->query($query);

        return $result->fetch_assoc();

	}

	public static function checkExistence($userId){
		$dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $userId = $sqlCon->escape_string($userId);

        $query = "SELECT * FROM userbio WHERE userid = '$userId'";

        $result = $sqlCon->query($query);

        $output = $result->fetch_assoc();


        return (empty($output))?0:array_shift($output);

	}
}

 ?>
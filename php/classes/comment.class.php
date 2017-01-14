<?php  
class Comment{
	
	public $id;
	/**
	 * name of person who comments
	 * @var $name string
	 */
	public $name;
	/**
	 * email of person who comments
	 * @var $email string
	 */
	public $email;
	/**
	 * date comment was added
	 * @var $datePosted Integer
	 */
	public $datePosted;
	/**
	 * id of project being commented
	 * @var $projectId string
	 */
	public $projectId;
	/**
	 * the comment
	 * @var $comment string
	 */
	public $comment;
	/**
	 * Determines if a comment is approved, waiting for approval or rejected 0 means awaiting approval, 1 means approved 2 means rejected
	 * @var $status string
	 */
	public $status;

    /**
     * The user id for the creator of the project being commented
     * @var $userId
     */
    public $userId;

	public function add(){
		$dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $name = $sqlCon->escape_string($this->name);
        $email = $sqlCon->escape_string($this->email);
        $datePosted = $sqlCon->escape_string($this->datePosted);
        $projectId = $sqlCon->escape_string($this->projectId);
        $comment = $sqlCon->escape_string($this->comment);
        $status = $sqlCon->escape_string($this->status);
        $userId = $sqlCon->escape_string($this->userId);

        $query = "INSERT INTO comments(id,name,email,date_posted,project_id,comment,status,userid)";
        $query.="VALUES(NULL,'$name','$email','$datePosted','$projectId','$comment',$status,'$userId')";

        $result = $sqlCon->query($query);

        return $result;
	}

    public static function approve($id){

        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($id);

        $query = "UPDATE comments SET status = 1 WHERE id = '$id'";

        $result = $sqlCon->query($query);

        return $result;

    }


    public static function reject($id){

        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($id);

        $query = "UPDATE comments SET status = 2 WHERE id = '$id'";

        $result = $sqlCon->query($query);

        return $result;

    }

    public static function delete($id){

        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($id);
        if($id==NULL){
            return false;
        }else{
            $query = "DELETE FROM comments WHERE id = '$id'";

            $result = $sqlCon->query($query);

            return $result;
        }

    }

    //get comments by project creator
    public function getCommentsByCreator($userId){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $userId = $sqlCon->escape_string($userId);

        $query = "SELECT * FROM comments WHERE userid = '$userId' ORDER BY id DESC";

        $result = $sqlCon->query($query);

        $results = array();
        $counter = 0;
        while ($row = $result->fetch_assoc()){
            $results[$counter] = $row;
            $counter++;
        }

        return $results;
    }

    public function getLatestComments($limit = 10, $offset = 0,$id = NULL){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($id);

        $query1 = "SELECT * FROM comments WHERE project_id = '$id' AND status=1 ORDER BY id DESC LIMIT $limit OFFSET $offset";
        //this version of $query is for the project creator/admin
        $query2 = "SELECT * FROM comments ORDER BY id DESC LIMIT $limit OFFSET $offset";

        $query=($id==NULL)?$query2:$query1;

        $result = $sqlCon->query($query);

        $results = array();
        $counter = 0;
        while ($row = $result->fetch_assoc()){
            $results[$counter] = $row;
            $counter++;
        }

        return $results;
    }

    public function checkExistence(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $name = $sqlCon->escape_string($this->name);
        $email = $sqlCon->escape_string($this->email);
        $comment = $sqlCon->escape_string($this->comment);

        $query = "SELECT * FROM comments WHERE name = '$name' AND email = '$email' AND comment = '$comment'";

        $result = $sqlCon->query($query);

        $output = $result->fetch_assoc();

        return (empty($output))?0:array_shift($output);

    }
}
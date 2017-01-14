<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 5/1/2017
 * Time: 12:48 PM
 */
class Project{

    /**
     * @var $id the project id
     */
    public $id;
    public $title;
    public $description;
    public $userId;
    public $image;
    public $category;
    public $tags;
    public $postingDate;
    public $completionDate;

    public function getLatestProjects($limit = 10, $offset = 0){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $query = "SELECT * FROM projects ORDER BY posting_date DESC LIMIT $limit OFFSET $offset";


        $result = $sqlCon->query($query);

        $results = array();
        $counter = 0;
        while ($row = $result->fetch_assoc()){
            $results[$counter] = $row;
            $counter++;
        }

        return $results;
    }

    public function getProjects($userId=null){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $userId = $sqlCon->escape_string($userId);

        if($userId==null){
            $query = "SELECT * FROM projects";
        }else{
            $query = "SELECT * FROM projects WHERE userid = '$userId'";
        }

        $result = $sqlCon->query($query);

        $results = array();
        $counter = 0;
        while ($row = $result->fetch_assoc()){
            $results[$counter] = $row;
            $counter++;
        }

        return $results;
    }

    public static function getProjectDetails($projectId){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $query = "SELECT * FROM projects WHERE id = '$projectId'";

        $result = $sqlCon->query($query);

        return $result->fetch_assoc();
    }

    public function addProject(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $id = $sqlCon->escape_string($this->id);
        $title = $sqlCon->escape_string($this->title);
        $description = $sqlCon->escape_string($this->description);
        $userId = $sqlCon->escape_string($this->userId);
        $image = $sqlCon->escape_string($this->image);
        $category = $sqlCon->escape_string($this->category);
        $tags = $sqlCon->escape_string($this->tags);
        $postingDate = $sqlCon->escape_string($this->postingDate);
        $completionDate = $sqlCon->escape_string($this->completionDate);

        $query = "INSERT INTO projects(id,title,description,userid,image,category,tags,posting_date,completion_date)";
        $query .= "VALUES('$id','$title','$description','$userId','$image','$category','$tags',$postingDate,$completionDate)";

        $result = $sqlCon->query($query);

        return $result;

    }

    public function checkExistence(){
        $dbInstance = DB::getInstance();
        $sqlCon = $dbInstance->getConnection();

        $title = $sqlCon->escape_string($this->title);
        $userId = $sqlCon->escape_string($this->userId);

        $query = "SELECT * FROM projects WHERE title = '$title' AND userid = '$userId'";

        $result = $sqlCon->query($query);

        $output = $result->fetch_assoc();

        return (empty($output))?0:array_shift($output);

    }

}
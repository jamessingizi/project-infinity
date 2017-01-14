<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/11/2017
 * Time: 1:24 PM
 */
header("Content-Type: application/json");
require_once './php/config.php';
require_once './php/classes/user.class.php';
require_once './php/classes/project.class.php';
require_once './php/classes/comment.class.php';
//get account information

if(!isset($_SESSION['user'])){
    header('location:index.php');
}

    sleep(2);
    $data = array();

    if (isset($_GET['id'])) {
        $id = \filter_input(\INPUT_GET, 'id');

        if (Comment::approve($id)) {
            $data['message'] = 'success';
        } else {
            $data['message'] = 'error';
        }
    } else {
        $data['message'] = 'error';
    }

    echo json_encode($data);

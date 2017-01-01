<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 25/11/2016
 * Time: 14:07
 */

require_once './php/config.php';
session_destroy();
echo "<script> window.location='./index.php';</script>";
<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 17/11/2016
 * Time: 21:20
 */

error_reporting(E_ALL);

session_start();

/**
 * disable caching for site
 */
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
set_time_limit(0);

//set default time zone
date_default_timezone_set('Africa/Harare');

$dbDirectory = realpath(dirname(__FILE__));
$dbPath = $dbDirectory."/db.class.php";
$encryption_key = 'd7827fce7d867b4253f20e0d3cebda49';

require_once ($dbPath);
require_once ($dbDirectory."/classes/validation.class.php");
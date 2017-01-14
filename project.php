<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 6/1/2017
 * Time: 8:14 AM
 */

require_once './php/config.php';
require_once './php/classes/user.class.php';
require_once './php/classes/project.class.php';
//get account information

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php';</script>";
}

if($_GET['uid']!=md5('elegant-code')){
    echo "<script>alert('invalid page access');window.location='dashboard.php'</script>";
}

$email = $_SESSION['user'];

$user = new User();
$user->email = $email;
$userDetails = $user->getDetails();


//get project details
$projectDetails = Project::getProjectDetails(htmlentities($_GET['pid']));

$title = 'Project Infinity | Dashboard';
require_once './php/includes/page_head.php';
?>
<body>
<link rel="stylesheet" href="css/clndr.css" />
<?php require_once './php/includes/user_dash/top_nav.php'; ?>
<?php require_once './php/includes/user_dash/second_nav.php'; ?>


<div class="courses_box1">
    <div class="container">
        <div class="col-md-4">
            <div class="cal1 cal_2"><div class="clndr"><div class="clndr-controls"><div class="clndr-control-button"><p class="clndr-previous-button">previous</p></div><div class="month">September 2015</div><div class="clndr-control-button rightalign"><p class="clndr-next-button">next</p></div></div><table class="clndr-table" border="0" cellspacing="0" cellpadding="0"><thead><tr class="header-days"><td class="header-day">S</td><td class="header-day">M</td><td class="header-day">T</td><td class="header-day">W</td><td class="header-day">T</td><td class="header-day">F</td><td class="header-day">S</td></tr></thead><tbody><tr><td class="day past adjacent-month last-month calendar-day-2015-08-30"><div class="day-contents">30</div></td><td class="day past adjacent-month last-month calendar-day-2015-08-31"><div class="day-contents">31</div></td><td class="day today calendar-day-2015-09-01"><div class="day-contents">1</div></td><td class="day calendar-day-2015-09-02"><div class="day-contents">2</div></td><td class="day calendar-day-2015-09-03"><div class="day-contents">3</div></td><td class="day calendar-day-2015-09-04"><div class="day-contents">4</div></td><td class="day calendar-day-2015-09-05"><div class="day-contents">5</div></td></tr><tr><td class="day calendar-day-2015-09-06"><div class="day-contents">6</div></td><td class="day calendar-day-2015-09-07"><div class="day-contents">7</div></td><td class="day calendar-day-2015-09-08"><div class="day-contents">8</div></td><td class="day calendar-day-2015-09-09"><div class="day-contents">9</div></td><td class="day event calendar-day-2015-09-10"><div class="day-contents">10</div></td><td class="day event calendar-day-2015-09-11"><div class="day-contents">11</div></td><td class="day event calendar-day-2015-09-12"><div class="day-contents">12</div></td></tr><tr><td class="day event calendar-day-2015-09-13"><div class="day-contents">13</div></td><td class="day event calendar-day-2015-09-14"><div class="day-contents">14</div></td><td class="day calendar-day-2015-09-15"><div class="day-contents">15</div></td><td class="day calendar-day-2015-09-16"><div class="day-contents">16</div></td><td class="day calendar-day-2015-09-17"><div class="day-contents">17</div></td><td class="day calendar-day-2015-09-18"><div class="day-contents">18</div></td><td class="day calendar-day-2015-09-19"><div class="day-contents">19</div></td></tr><tr><td class="day calendar-day-2015-09-20"><div class="day-contents">20</div></td><td class="day event calendar-day-2015-09-21"><div class="day-contents">21</div></td><td class="day event calendar-day-2015-09-22"><div class="day-contents">22</div></td><td class="day event calendar-day-2015-09-23"><div class="day-contents">23</div></td><td class="day calendar-day-2015-09-24"><div class="day-contents">24</div></td><td class="day calendar-day-2015-09-25"><div class="day-contents">25</div></td><td class="day calendar-day-2015-09-26"><div class="day-contents">26</div></td></tr><tr><td class="day calendar-day-2015-09-27"><div class="day-contents">27</div></td><td class="day calendar-day-2015-09-28"><div class="day-contents">28</div></td><td class="day calendar-day-2015-09-29"><div class="day-contents">29</div></td><td class="day calendar-day-2015-09-30"><div class="day-contents">30</div></td><td class="day adjacent-month next-month calendar-day-2015-10-01"><div class="day-contents">1</div></td><td class="day adjacent-month next-month calendar-day-2015-10-02"><div class="day-contents">2</div></td><td class="day adjacent-month next-month calendar-day-2015-10-03"><div class="day-contents">3</div></td></tr></tbody></table></div></div>

        </div>
        <div class="col-md-8 detail">
            <?php if(empty($projectDetails)){
                echo 'Project Not found';
            }else{


            ?>
            <img src="<?php echo $projectDetails['image'];?>" class="img-responsive" alt=""/>
            <h3><?php echo htmlentities($projectDetails['title']) ?></h3>
            <ul class="meta-post">

                <li class="view">
                    <?php echo strftime('%d.%m.%y',(int)$projectDetails['completion_date'])?>
                </li>
                <li class="category">
                    <?php echo $projectDetails['category'] ?>
                </li>

                <li >
                    <i class="fa fa-comments" style="color: #f1b458";></i>
                    10
                </li>

                <li >
                    <i class="fa fa-users" style="color: #f1b458";></i>
                    03
                </li>

                <li >
                    <a href="#">
                        <i class="fa fa-edit" style="color: #2f374c";></i>
                        Edit
                    </a>
                </li>

                <li >
                    <a href="#">
                        <i class="fa fa-edit" style="color: #2f374c";></i>
                        Delete
                    </a>
                </li>

            </ul>
            <p><?php echo htmlentities($projectDetails['description'])?></p>

            <?php
                //close if statement for empty project details
            }
            ?>

        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<!-- calendar scripts -->
<link rel="stylesheet" href="css/clndr.css" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>

<?php require_once './php/includes/footer.php' ?>
</body>
</html>

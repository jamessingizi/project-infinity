<?php
require_once './php/config.php';
require_once './php/classes/user.class.php';
//get account information

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php';</script>";
}

$email = $_SESSION['user'];

$user = new User();
$user->email = $email;
$userDetails = $user->getDetails();

$title = 'Project Infinity | Dashboard';
require_once './php/includes/page_head.php';
?>
<body>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<?php require_once './php/includes/user_dash/top_nav.php'; ?>
<?php require_once './php/includes/user_dash/second_nav.php'; ?>


<div class="admission">
    <div class="container">
        <div class="clearfix"> </div>
        <table class="timetable table-hover" style="margin-top: -20px; text-transform: uppercase" id="my_projects">
            <caption style="font-size: 2em">My projects</caption>
            <thead>
            <tr>
                <th>Project Title </th>
                <th>Category</th>
                <th>Tags</th>
                <th>Date Created</th>
                <th>Completion Date</th>
                <th>Sponsor</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

        <div class="clearfix"> </div>

    </div>
</div>
<?php require_once './php/includes/footer.php' ?>

<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('#my_projects').DataTable( {
            colReorder: true,
            rowReorder: true
        });
    });
</script>
</body>
</html>
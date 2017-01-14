<?php
require_once './php/config.php';
require_once './php/classes/user.class.php';
require_once './php/classes/project.class.php';
//get account information

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php';</script>";
}

$email = $_SESSION['user'];

$user = new User();
$user->email = $email;
$userDetails = $user->getDetails();

//get user projects
$project = new Project();
$projects = $project->getProjects($userDetails['id']);

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
        <table class="timetable table-hover" style="margin-top: -30px; text-transform: uppercase" id="my_projects">
            <caption style="font-size: 2em">My projects</caption>
            <thead>
            <tr>
                <th>Project Title </th>
                <th>Category</th>
                <th>Tags</th>
                <th>Date Created</th>
                <th>Completion Date</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($projects as $eachProject){
            ?>
                    <tr>
                        <td>
                            <a href="project.php?sti=<?php echo time();?>&pid=<?php echo $eachProject['id']?>&uid=<?php echo md5('elegant-code')?>">
                                <?php echo $eachProject['title']; ?>
                            </a>
                        </td>
                        <td><?php echo $eachProject['category']; ?></td>
                        <td><?php echo str_replace(',',' ',$eachProject['tags']); ?></td>
                        <td><?php echo strftime('%A %d %B %Y',$eachProject['posting_date']); ?></td>
                        <td><?php echo strftime('%A %d %B %Y',$eachProject['completion_date']); ?></td>
                        <td><?php echo (strlen($eachProject['description'])>20)?substr($eachProject['description'],0,40)."...":$eachProject['description'] ?></td>
                    </tr>
            <?php
                }
            ?>
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
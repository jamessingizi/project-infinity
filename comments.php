<?php
require_once './php/config.php';
require_once './php/classes/user.class.php';
require_once './php/classes/project.class.php';
require_once './php/classes/comment.class.php';
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

//get comments
$comment = new Comment();
$allComments = $comment->getCommentsByCreator($userDetails['id']);

$title = 'Project Infinity | Comments';
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
            <caption style="font-size: 2em">User Comments</caption>
            <thead>
            <tr>
                <th>Project Title </th>
                <th>Name</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Date Posted</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($allComments as $eachComment){
                ?>
                <tr>
                    <td>
                        <a href="project.php?sti=<?php echo time();?>&pid=<?php echo $eachComment['project_id']?>&uid=<?php echo md5('elegant-code')?>">
                            <?php echo Project::getProjectDetails($eachComment['project_id'])['title']; ?>
                        </a>
                    </td>
                    <td style="text-align: left"><?php echo $eachComment['name']; ?></td>
                    <td style="text-align: left"><?php echo $eachComment['email']; ?></td>
                    <td style="text-align: left"><?php echo $eachComment['comment']; ?></td>
                    <td style="text-align: left"><?php echo strftime('%A %d %B %Y',$eachComment['date_posted']); ?></td>
                    <td>
                        <?php

                            if ($eachComment['status']==0){
                        ?>
                        <a href="#" class="authorise_comment" id="<?php echo $eachComment['id']; ?>" data-id = "<?php echo $eachComment['id']; ?>">Authorise &nbsp;</a>
                        <a href="#" id="<?php echo $eachComment['id']; ?>" class="delete_comment" data-id = "<?php echo $eachComment['id']; ?>">Delete &nbsp;</a>
                        <?php
                            }else{
                        ?>
                        <a href="#" id="<?php echo $eachComment['id']; ?>" data-status="<?php echo $eachComment['status']; ?>" class="suppress_comment" data-id = "<?php echo $eachComment['id']; ?>">
                            <?php if ($eachComment['status']==1){
                                echo 'Suppress &nbsp;';
                            }elseif($eachComment['status']==2){
                                echo 'Activate &nbsp;';
                            } ?>
                        </a>
                        <a href="#" id="<?php echo $eachComment['id']; ?>" class="delete_comment" data-id = "<?php echo $eachComment['id']; ?>">Delete &nbsp;</a>
                        <?php
                            }
                        ?>



                    </td>
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
<script src="./js/myscript.js"></script>

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
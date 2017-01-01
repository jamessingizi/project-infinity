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

$title = 'Project Infinity | Create Project';
require_once './php/includes/page_head.php';
?>
<body>
<?php require_once './php/includes/user_dash/top_nav.php'; ?>
<?php require_once './php/includes/user_dash/second_nav.php'; ?>


<div class="admission">
    <div class="container">
        <div class="clearfix"> </div>

        <div>
            <form>
                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="title"  placeholder="Title"
                           type="text" required id="slider-name" >
                </div>

                <div class="select-block1">
                    <select>
                        <option value="">Category</option>
                        <option value="">Finance</option>
                        <option value="">Business</option>
                        <option value="">Programming</option>
                    </select>
                </div>

                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="tags"
                           placeholder="Tags(tags should be comma separated)"  type="text" required id="slider-name" >
                </div>

                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="completion_date"
                           placeholder="Completion Date (eg 31/12/90)" type="text" required id="slider-name" >
                </div>

                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="sponsor"
                           placeholder="Sponsor (Optional)" type="text" id="slider-name" >
                </div>

                <div class="input-group input-group1">
                    <textarea class="form-control has-dark-background" name="description"
                              id="" cols="30" rows="5"placeholder="Project description"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg1 btn-block" name="submit" value="Create Project">
                </div>

            </form>
        </div>


        <div class="clearfix"> </div>

    </div>
</div>
<?php require_once './php/includes/footer.php' ?>

</body>
</html>
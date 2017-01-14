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

$title = 'Project Infinity | Create Project';
require_once './php/includes/page_head.php';
?>
<body>
<?php require_once './php/includes/user_dash/top_nav.php'; ?>
<?php require_once './php/includes/user_dash/second_nav.php'; ?>

<link rel="stylesheet" href="./css/jquery-ui.css"/>
<div class="admission">
    <div class="container">
        <div class="clearfix"> </div>

        <div>
            <h3 style="margin-top: -20px;">Create New Project</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="title"  placeholder="Title"
                           type="text" required id="slider-name" >
                </div>

                <div class="select-block1">
                    <select name="category">
                        <option value="null">Category</option>
                        <option value="Applied_Mathematics">Applied Mathematics</option>
                        <option value="Business">Business</option>
                        <option value="Cloud_Computing">Cloud Computing</option>
                        <option value="Computer_Security">Computer Security</option>
                        <option value="Design">Design</option>
                        <option value="Food_Engineering">Food Engineering</option>
                        <option value="Industrial_Design">Industrial Design</option>
                        <option value="Web_Design">Web Design</option>
                    </select>
                </div>

                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="tags"
                           placeholder="Tags(tags should be comma separated)"  type="text" id="slider-name" >
                </div>

                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="completion_date"
                           placeholder="Completion Date" type="text" required id="completion_date" >
                </div>

                <div class="input-group input-group1">
                    <textarea class="form-control has-dark-background" name="description"
                              id="" cols="30" rows="5"placeholder="Project description" required></textarea>
                </div>

                <div class="input-group input-group1">

                    <input class="form-control has-dark-background" name="image"
                           placeholder="Featured image" type="file" id="slider-name" >
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg1 btn-block" name="submit" value="Create Project">
                </div>

            </form>
        </div>


        <div class="clearfix"> </div>

    </div>
</div>
<script src="./js/jquery-ui.min.js"></script>
<script>
    $.datepicker.setDefaults( $.datepicker.regional[ "zw" ] );
    $( "#completion_date" ).datepicker({minDate: "+1d",dateFormat: "yy-mm-dd"});
</script>
<?php require_once './php/includes/footer.php' ?>

<?php
    if(isset($_POST['submit'])){
        //get data
        $title = \filter_input(\INPUT_POST,'title');
        $description = \filter_input(\INPUT_POST,'description');
        $category = str_replace('_',' ',\filter_input(\INPUT_POST,'category'));
        $tags = \filter_input(\INPUT_POST,'tags');
        $completionDateString = \filter_input(\INPUT_POST,'completion_date');

        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageExtension = strtolower(substr($imageName,strpos($imageName,'.')+1));

        //validate data
        if(strlen($title)<1){
            echo "<script>alert('Invalid project title, use at least 3 characters');</script>";
            exit();
        }

        if(strlen($description)<3){
            echo "<script>alert('Invalid project title, use at least 3 characters');</script>";
            exit();
        }

        if($category=='null'){
            echo "<script>alert('Select a category please!!!');</script>";
            exit();
        }

        if($completionDateString==null){
            echo "<script>alert('Select project completion date');</script>";
            exit();
        }

        if(!Validation::image($imageExtension,$imageType)){
            echo "<script>alert('Invalid image type, only jpeg and png files are allowed');</script>";
            exit();
        }

        if($imageSize>2097152){
            echo "<script>alert('Your image should be less than 2MB');</script>";
            exit();
        }


        list($year, $month, $day) = explode('-',$completionDateString);

        $completionDate = mktime(0,0,0,$month,$day,$year);

        $project = new Project();

        $project->category=$category;
        $project->title = $title;
        $project->description = $description;
        $project->tags = $tags;
        $project->completionDate = $completionDate;
        $project->id = md5(mcrypt_create_iv(32));
        $project->userId = $userDetails['id'];
        $project->postingDate=time();

        $uploads = './images/projects/';
        $imageLocation = $uploads.time().$imageName;


        //check project existence
        if($project->checkExistence()>0){
            echo "<script>alert('You have another project with the same name');</script>";
            exit();
        }

        if(move_uploaded_file($imageTemp,$imageLocation)){
            $project->image = $imageLocation;

            if($project->addProject()){
                echo "<script>alert('Project added successfully');</script>";
            }else{
                echo "<script>alert('Project could not be created due to an application error');</script>";
            }
        }else{
            echo "<script>alert('Error uploading project image, Project could not be created as a result');</script>";
        }
    }
?>

</body>
</html>
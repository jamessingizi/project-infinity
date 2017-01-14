<?php
require_once './php/config.php';
require_once './php/classes/user.class.php';
require_once './php/classes/project.class.php';
require_once './php/classes/userbio.class.php';
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

        <div class="col-lg-4">
            <h4>Account Details</h4>
            <ul class="list-group">
                <li class="list-group-item"><?php echo $userDetails['email']; ?>&nbsp;</li>
                <li class="list-group-item"><?php echo $userDetails['firstname'].' '.$userDetails['lastname']; ?>&nbsp;</li>
                <li class="list-group-item"><?php echo empty($userDetails['cell'])?'Cell number':htmlentities($userDetails['cell']); ?>&nbsp;</li>
                <li class="list-group-item"><?php echo empty($userDetails['city'])?'City':htmlentities($userDetails['city']); ?>&nbsp;</li>
                <li class="list-group-item"><?php echo empty($userDetails['country'])?'Country':htmlentities($userDetails['country']); ?>&nbsp;</li>
                <li class="list-group-item">
                    <?php
                        $userBio = Userbio::getBio($userDetails['id']);
                        if(empty($userBio)){
                            echo 'User bio unavailable, please update your account';
                        }else{
                          echo $userBio['bio'];  
                        }
                        
                    ?>&nbsp;
                </li>
            </ul>
        </div>

        <div class="col-lg-8">
            <h3>Update Account Details</h3>
            <form action="" method="post">
                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="firstname"  placeholder="First name"
                           type="text" required id="slider-name" value="<?php echo htmlentities($userDetails['firstname'])?>" >
                </div>

                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="lastname"  placeholder="Surname"
                           type="text" required id="slider-name" value="<?php echo htmlentities($userDetails['lastname'])?>" >
                </div>
                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="cell"  placeholder="Cell number"
                           type="text" required id="slider-name" value="<?php echo htmlentities($userDetails['cell'])?>" >
                </div>
                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="city"  placeholder="City"
                           type="text" required id="slider-name" value="<?php echo htmlentities($userDetails['city'])?>" >
                </div>
                 <div class="select-block1">
                    <select name="country">
                        <option value="null">--Select Country--</option>
                        <option value="USA">USA</option>
                        <option value="South_Africa">South Africa</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg1 btn-block" name="submit" value="Update Account">
                </div>

            </form>

            <hr>

            <?php 
                if(Userbio::checkExistence($userDetails['id'])>0){
            ?>
            <h3>Update Account Bio</h3>

            <form action="" method="post">
                <div class="input-group input-group1">
                    <textarea class="form-control has-dark-background" name="account-bio"
                              id="" cols="30" rows="5" placeholder="User Bio" required><?php echo $userBio['bio']; ?></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg1 btn-block" name="update-account-bio" value="Update Account Bio">
                </div>

            </form>

            <?php
                }else{
            ?>

                <h3>Add Account Bio</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group input-group1">
                        <textarea class="form-control has-dark-background" name="bio"
                                  id="" cols="30" rows="5" placeholder="User Bio" required></textarea>
                    </div>

                    <div class="input-group input-group1">

                        <input class="form-control has-dark-background" name="bio-image"
                               placeholder="Account picture" type="file" required id="slider-name" >
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-lg1 btn-block" name="update-bio" value="Add Account Bio">
                    </div>

                </form>

            <?php  
                }
            ?>
            
    
            <hr>

            <h3>Update Account Password</h3>
            <form action="" method="post">
                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="current_password"  placeholder="Current password" type="password" required id="slider-name" >
                </div>

                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="new_password"  placeholder="New password"
                           type="password" required id="slider-name" >
                </div>
                <div class="input-group input-group1">
                    <input class="form-control has-dark-background" name="repeat_new_password"  placeholder="repeat new password" type="password" required id="slider-name" >
                </div>
               
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg1 btn-block" name="submit-password" value="Update Account Password">
                </div>

            </form>
        </div>


        <div class="clearfix"> </div>

    </div>
</div>
<?php require_once './php/includes/footer.php' ?>

<?php

    //update account bio
    if(isset($_POST['update-account-bio'])){
        $accountBio = htmlentities(\filter_input(\INPUT_POST,'account-bio'));

        //validate data
        if(strlen($accountBio)<20){
            echo "<script>alert('Your bio is too short, write a reasonable one');</script>";
            exit();
        }

        $userAccountBio = new Userbio();
        $userAccountBio->bio = $accountBio;
        $userAccountBio->userId = $userDetails['id'];

        if($userAccountBio->update()){
            echo "<script>alert('Bio updated successfully');</script>";
        }else{
            echo "<script>alert('Application error occurred, please try again later');</script>";
        }

    }
    
    //add account bio
    if(isset($_POST['update-bio'])){
        //this adds a new account bio
        $bio = htmlentities(\filter_input(\INPUT_POST,'bio'));

        $imageName = $_FILES['bio-image']['name'];
        $imageSize = $_FILES['bio-image']['size'];
        $imageType = $_FILES['bio-image']['type'];
        $imageTemp = $_FILES['bio-image']['tmp_name'];
        $imageExtension = strtolower(substr($imageName,strpos($imageName,'.')+1));

        //validate data
        if(!Validation::image($imageExtension,$imageType)){
            echo "<script>alert('Invalid image type, only jpeg and png files are allowed');</script>";
            exit();
        }

        if($imageSize>2097152){
            echo "<script>alert('Your image should be less than 2MB');</script>";
            exit();
        }

        if(strlen($bio)<20){
            echo "<script>alert('Your bio is too short, write a reasonable one');</script>";
            exit();
        }

        //create bio
        $userBio = new Userbio();
        $userBio->bio = $bio;
        $userBio->userId = $userDetails['id'];

        //prepare image
        $uploads = './images/';
        $imageLocation = $uploads.time().$imageName;

        //check existence of bio
        if($userBio->checkExistence($userDetails['id'])>0){
            echo "<script>alert('User bio already exists');</script>";
            exit();
        }

        if (move_uploaded_file($imageTemp,$imageLocation)) {
            $userBio->image = $imageLocation;
            if($userBio->add()){
                echo "<script>alert('User bio added successfully');</script>";
            }else{
                echo "<script>alert('An application error has occurred, please try again');</script>";
            }
        }else{
            echo "<script>alert('An application error has occurred, please try again');</script>";
        }


    }


    if(isset($_POST['submit'])){

        //get data
        $firstName = \filter_input(\INPUT_POST,'firstname');
        $lastName = \filter_input(\INPUT_POST,'lastname');
        $cell = str_replace('_',' ',\filter_input(\INPUT_POST,'cell'));
        $city = \filter_input(\INPUT_POST,'city');
        $country = \filter_input(\INPUT_POST,'country');

        //validate data
        if(strlen($firstName)<=1){
            echo "<script>alert('Your name is too short');</script>";
            exit();
        }

        if(strlen($lastName)<=1){
            echo "<script>alert('Your surname is too short');</script>";
            exit();
        }

        if($country=='null'){
            echo "<script>alert('Select a country please!');</script>";
            exit();
        }

        if(strlen($city)<3){
            echo "<script>alert('Enter a valid city name');</script>";
            exit();
        }

        if(!Validation::cell($cell)){
            echo "<script>alert('Enter a valid cell number eg 0771082367 or +263778901273');</script>";
            exit();
        }

        //create user object
        $userUp = new User();

        $userUp->cell = $cell;
        $userUp->country = str_replace('_',' ',$country);
        $userUp->firstName = $firstName;
        $userUp->lastName = $lastName;
        $userUp->city = $city;
        $userUp->id = $userDetails['id'];

        if($userUp->updateAccount()){
            echo "<script>alert('Account details updated successfully');</script>";
        }else{
            echo "<script>alert('Application error occurred, please try again');</script>";
        }


       
    }

    if(isset($_POST['submit-password'])){
         $currentPassword = \filter_input(\INPUT_POST,'current_password');
         $newPassword = \filter_input(\INPUT_POST,'new_password');
         $repeatNewPassword = \filter_input(\INPUT_POST,'repeat_new_password');

         //validate data
         if(md5($encryption_key.$currentPassword)!=$userDetails['password']){
            echo "<script>alert('Invalid password');</script>";
            exit();
         }

         if(strlen($newPassword)<8){
            echo "<script>alert('Your password is too short');</script>";
            exit();
         }

         if($newPassword!=$repeatNewPassword){
            echo "<script>alert('Your new passwords do not match');</script>";
            exit();
         }

         if(User::updatePassword(md5($encryption_key.$newPassword),$userDetails['id'])){
            echo "<script>alert('Password updated successfully');</script>";
         }else{
            echo "<script>alert('Application error occurred, please try again');</script>";
         }
    }
?>

</body>
</html>

<?php
    require_once './php/config.php';
    require_once './php/classes/user.class.php';
    $title = 'Project Infinity | Register';
    require_once './php/includes/page_head.php';
?>
<body>
<?php require './php/includes/top_nav.php'; ?>
<?php require './php/includes/second_nav.php'; ?>


<!-- banner -->
  <div class="courses_banner">
  	<div class="container">
  		<h3>Register</h3>
  		<p class="description">
             Become family of something bigger than you or any of us. And together we can change the world.</p>
  		<p class="description">&quot;l believe empty pockets never help anyone back&quot;</p>
        <div class="breadcrumb1">
          <ul>
                <li class="icon6"><a href="index.php">Home</a></li>
                <li class="current-page">Register</li>
            </ul>
        </div>
  	</div>
  </div>
    <!-- //banner -->
	<div class="courses_box1">
	   <div class="container">
	   	  <form class="login" action="" method="post">
                <p class="lead">Join The Family</p>
				  <div class="form-group">
					  <input type="email" autocomplete="off" class="required form-control" placeholder="Email *" required
							 name="email" value="<?php echo isset($_POST['email'])?\filter_input(\INPUT_POST,'email'):''?>">
				  </div>

				  <div class="form-group">
					  <input type="text" autocomplete="off" class="required form-control" placeholder="First Name *" required
						   name="firstName" value="<?php echo isset($_POST['firstName'])?\filter_input(\INPUT_POST,'firstName'):''?>">
				  </div>

				  <div class="form-group">
					  <input type="text" autocomplete="off" class="required form-control" placeholder="Surname *" required
							 name="surname" value="<?php echo isset($_POST['surname'])?\filter_input(\INPUT_POST,'surname'):''?>">
				  </div>

                <div class="form-group">
                    <input type="password" class="required form-control" placeholder="Password (At least 8 characters)*"
						   name="password" required>
                </div>

                <div class="form-group">
                    <input type="password" class="required form-control" placeholder="Confirm Password *"
						   name="confirm_password" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg1 btn-block" name="submit" value="Register">
                </div>
                <p>Already have an account? <a href="login.php">Sign In</a></p>
            </form>
	   </div>
	</div>
        <?php require 'php/includes/footer.php' ?>
<?php
if(isset($_POST['submit'])){
	$email = \filter_input(\INPUT_POST,'email');
	$firstName = \filter_input(\INPUT_POST,'firstName');
	$lastName = \filter_input(\INPUT_POST,'surname');
	$password = \filter_input(\INPUT_POST,'password');
	$confirmPassword = \filter_input(\INPUT_POST,'confirm_password');

	//validate user input
	if(!Validation::v_email($email)){
		echo '<script>alert("Invalid email address");</script>';
		exit();
	}

	if(!Validation::v_name($firstName)){
		echo '<script>alert("Invalid first name, use alphanumeric characters only");</script>';
		exit();
	}

	if(!Validation::v_name($lastName)){
		echo '<script>alert("Invalid Surname, use alphanumeric characters only");</script>';
		exit();
	}

	if(!Validation::v_password($password)){
		echo '<script>alert("Your password is too short");</script>';
		exit();
	}

	if($password!=$confirmPassword){
		echo '<script>alert("Your passwords do not match");</script>';
		exit();
	}

	//create account
	$user = new User();
	$user->id = md5(mcrypt_create_iv(64));
	$user->accountStatus = 1;
	$user->created = time();
	$user->email = $email;
	$user->firstName = $firstName;
	$user->lastName = $lastName;
	$user->password = md5($encryption_key.$password);
	$user->city = '';
	$user->country = '';
	$user->lastAccessed = 0;

	if($user->checkExistence()>0){
		echo '<script>alert("Account already exists, make sure it\'s verified and login");</script>';
	}else{
		//send verification email with phpMailer and create account
		if($user->addAccount()){
			unset($_POST['email']);
			unset($_POST['firstName']);
			unset($_POST['surname']);
			echo '<script>alert("Account created successfully, An email has been send to you, click the verification link to verify");</script>';
		}else{
			echo '<script>alert("An application error has occurred please try again");</script>';
		}
	}
}
?>
</body>
</html>	
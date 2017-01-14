<?php
    require_once './php/config.php';
    require_once './php/classes/user.class.php';
    $title = 'Project Infinity | Login';
    require_once './php/includes/page_head.php';
?>

<body>

<?php require_once './php/includes/top_nav.php'; ?>
<?php require_once './php/includes/second_nav.php'; ?>

<!-- banner -->
  <div class="courses_banner">
  	<div class="container">
  		<h3>Login</h3>
  		<p class="description">
             Quick Login to post and review projects. Participate and help grow the knowledge database.
            Try to make it your Goal to com up with something everyday.
        </p>
        <div class="breadcrumb1">
            <ul>
                <li class="icon6"><a href="index.php">Home</a></li>
                <li class="current-page">Login</li>
            </ul>
        </div>
  	</div>
  </div>
    <!-- //banner -->
	<div class="courses_box1">
	   <div class="container">
	   	  <form class="login" autocomplete="off" action="" method="post">
	    	<p class="lead">Welcome Back!</p>
		    <div class="form-group">
			    <input autocomplete="off" type="email" name="login_email" class="required form-control"
                       placeholder="Email" required>
		    </div>
		    <div class="form-group">
			    <input autocomplete="off" type="password" class="password required form-control"
                       placeholder="Password" name="login_password" required>
		    </div>
		    <div class="form-group">
		    	<input type="submit" class="btn btn-primary btn-lg1 btn-block" name="submit" value="Log In">
		    </div>
	        <p>Do not have an account? <a href="register.php" title="Sign Up">Sign Up</a></p>
		 </form>
	   </div>
	</div>
    <?php require 'php/includes/footer.php' ?>

<?php
if(isset($_POST['submit'])){

    //start with validation
    $email = filter_input(INPUT_POST,'login_email');
    $password = filter_input(INPUT_POST,'login_password');

    $user = new User();
    $user->email = htmlentities($email);


    $userDetails = $user->getDetails();

    if(empty($userDetails)){
        //invalid login
        echo '<script>alert("Invalid login");</script>';
    }else{
        if($userDetails['account_status']!= 1){
            //account inactive
            echo '<script>alert("Your account is inactive, please verify your account");</script>';
        }else{
            if($userDetails['password']==md5($encryption_key.htmlentities($password))){
                //login successful
                $_SESSION['user'] = $email;
                echo "<script>window.location = 'dashboard.php'</script>";
            }else{
                //invalid login
                echo '<script>alert("Invalid login");</script>';
            }
        }
    }

}
?>
</body>
</html>	
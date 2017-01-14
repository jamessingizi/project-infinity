
<?php
require_once './php/config.php';
$title = 'Project Infinity | Project details';
require_once './php/includes/page_head.php';
require_once './php/classes/project.class.php';
require_once './php/classes/user.class.php';
require_once './php/classes/userbio.class.php';
require_once './php/classes/pagination.class.php';
require_once './php/classes/comment.class.php';

if (!isset($_GET['pid'])) {
	echo "<script>window.location = 'index.php';</script>";
}

if($_GET['uid']!=md5('elegant-code')){
    echo "<script>alert('invalid page access');window.location='index.php'</script>";
}

//get project details
$projectDetails = Project::getProjectDetails(\filter_input(\INPUT_GET,'pid'));
?>

<body>

<?php require_once './php/includes/top_nav.php'; ?>
<?php require_once './php/includes/second_nav.php'; ?>


<!-- banner -->
  <div class="bg">
	    <div class="container">
	        <div class="timer_wrap">
	        	<div id="counter"> </div>   
	        </div> 
	       <div class="newsletter">
		        <form>
			        <input type="text" name="ne" size="30" required="" placeholder="Please fill your email">
			        <input type="submit" value="Subscribe">
		        </form>
	    	</div>
	    </div>
   </div>
    <!-- //banner -->
	<div class="courses_box1">
	   <div class="container">
	   	  <div class="col-md-4">
			<!-- calendar comes here -->

			 <div class="cal1 cal_2"><div class="clndr"><div class="clndr-controls"><div class="clndr-control-button"><p class="clndr-previous-button">previous</p></div><div class="month">September 2015</div><div class="clndr-control-button rightalign"><p class="clndr-next-button">next</p></div></div><table class="clndr-table" border="0" cellspacing="0" cellpadding="0"><thead><tr class="header-days"><td class="header-day">S</td><td class="header-day">M</td><td class="header-day">T</td><td class="header-day">W</td><td class="header-day">T</td><td class="header-day">F</td><td class="header-day">S</td></tr></thead><tbody><tr><td class="day past adjacent-month last-month calendar-day-2015-08-30"><div class="day-contents">30</div></td><td class="day past adjacent-month last-month calendar-day-2015-08-31"><div class="day-contents">31</div></td><td class="day today calendar-day-2015-09-01"><div class="day-contents">1</div></td><td class="day calendar-day-2015-09-02"><div class="day-contents">2</div></td><td class="day calendar-day-2015-09-03"><div class="day-contents">3</div></td><td class="day calendar-day-2015-09-04"><div class="day-contents">4</div></td><td class="day calendar-day-2015-09-05"><div class="day-contents">5</div></td></tr><tr><td class="day calendar-day-2015-09-06"><div class="day-contents">6</div></td><td class="day calendar-day-2015-09-07"><div class="day-contents">7</div></td><td class="day calendar-day-2015-09-08"><div class="day-contents">8</div></td><td class="day calendar-day-2015-09-09"><div class="day-contents">9</div></td><td class="day event calendar-day-2015-09-10"><div class="day-contents">10</div></td><td class="day event calendar-day-2015-09-11"><div class="day-contents">11</div></td><td class="day event calendar-day-2015-09-12"><div class="day-contents">12</div></td></tr><tr><td class="day event calendar-day-2015-09-13"><div class="day-contents">13</div></td><td class="day event calendar-day-2015-09-14"><div class="day-contents">14</div></td><td class="day calendar-day-2015-09-15"><div class="day-contents">15</div></td><td class="day calendar-day-2015-09-16"><div class="day-contents">16</div></td><td class="day calendar-day-2015-09-17"><div class="day-contents">17</div></td><td class="day calendar-day-2015-09-18"><div class="day-contents">18</div></td><td class="day calendar-day-2015-09-19"><div class="day-contents">19</div></td></tr><tr><td class="day calendar-day-2015-09-20"><div class="day-contents">20</div></td><td class="day event calendar-day-2015-09-21"><div class="day-contents">21</div></td><td class="day event calendar-day-2015-09-22"><div class="day-contents">22</div></td><td class="day event calendar-day-2015-09-23"><div class="day-contents">23</div></td><td class="day calendar-day-2015-09-24"><div class="day-contents">24</div></td><td class="day calendar-day-2015-09-25"><div class="day-contents">25</div></td><td class="day calendar-day-2015-09-26"><div class="day-contents">26</div></td></tr><tr><td class="day calendar-day-2015-09-27"><div class="day-contents">27</div></td><td class="day calendar-day-2015-09-28"><div class="day-contents">28</div></td><td class="day calendar-day-2015-09-29"><div class="day-contents">29</div></td><td class="day calendar-day-2015-09-30"><div class="day-contents">30</div></td><td class="day adjacent-month next-month calendar-day-2015-10-01"><div class="day-contents">1</div></td><td class="day adjacent-month next-month calendar-day-2015-10-02"><div class="day-contents">2</div></td><td class="day adjacent-month next-month calendar-day-2015-10-03"><div class="day-contents">3</div></td></tr></tbody></table></div></div>
			 <!--end calendar -->
	      
		</div>
		<?php 
			if (empty($projectDetails)) {
				echo '<h3>Project not found</h3>';
			}else{
		?>
		
		<div class="col-md-8 detail">
			<img src="<?php echo htmlentities($projectDetails['image']); ?>" class="img-responsive" alt="" width="1000" height="424" />

			<h3><?php echo htmlentities($projectDetails['title']); ?></h3>

			<h5>Project Descripton</h5>
			<p>
				<?php echo htmlentities($projectDetails['description']); ?>
			</p>

			<p>
				<span><em>Created On: <?php echo strftime("%A %d %B %Y",$projectDetails['posting_date'])?> &nbsp; | &nbsp; Category: <?php echo $projectDetails['category'];?> &nbsp; | &nbsp; Tags: <?php echo str_replace(',',' ',$projectDetails['tags']);?></em></span>
			</p>
			<br>

              <div class="author-box">
                  <div class="author-box-left">
                  <?php 
                  	$userBio = Userbio::getBio($projectDetails['userid']);
                   ?>
                  <img src="<?php echo (empty($userBio))?'./images/placeholder.jpg':$userBio['image']?>" class="img-responsive" style="border-radius: 4px" alt=""/>
                  </div>
				  <div class="author-box-right">		
					<h4>Created by <a href="#">
						<?php 
							$author = User::getAccountInfo($projectDetails['userid']);
							echo ucwords($author['firstname'].' '.$author['lastname']);
						?>
					</a></h4>
                    <p>
                    	<?php echo (empty($userBio))?'User profile is unavailable':$userBio['bio']?>
                    </p>
				  </div>
				  <div class="clearfix"> </div>
			 </div>
			 <div class="comment_section">
			 	<h4>Comments</h4>
			 	<ul class="comment-list">
				<?php 
					$displayComment = new Comment();
					$displayComments = $displayComment->getLatestComments(10,0,$projectDetails['id']);
					if(empty($displayComments)){
						echo '<em>This project does not have any comments</em>';
						echo '<br><br>';
					}
					foreach ($displayComments as $eachDisplayComment) {
				?>
				<li>
				     <div class="author-box">
				       <div class="author-box_left"><img src="images/author.png" class="img-responsive" alt=""/></div>
				       <div class="author-box_right">
				        <h5><a href="#"><?php echo $eachDisplayComment['name']; ?></a></h5>
			            <span class="m_1">
			            	<?php echo strftime('%A %d %B %Y, %H:%M:%S',$eachDisplayComment['date_posted']); ?>
			            </span>
			            <p><?php echo html_entity_decode($eachDisplayComment['comment']); ?></p>
				
				      </div> 
				      <div class="clearfix"> </div>
				     </div>
				  </li>
				<?php
					}

				?>
				</ul>
			
			 </div>
			 <form class="comment-form" method="post" action="">
			 	<h4>Leave a comment</h4>
				  <div class="col-md-6 comment-form-left">
					<input type="text" placeholder="Your Name" value="" id="author" name="author" class="form-control">
	                <input type="email" class="form-control" placeholder="Your Email" value="" id="email" name="email">
	              </div>
				  <div class="col-md-6 comment-form-right">
					<textarea name="comment" aria-required="true" id="comment" class="form-control" placeholder="Comment"></textarea>
				  </div>
				  <div class="clearfix"> </div>						
				  <div class="form-submit">
				  	<input name="submit" type="submit" id="submit" class="submit_1 btn btn-primary btn-block" value="Add comment"> 
				  </div>	  
           </form>
		  </div>

		<?php
			}
		?>
		  <div class="clearfix"> </div>
	   </div>
	</div>
      
      


<!-- calendar scripts -->
<link rel="stylesheet" href="css/clndr.css" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>

<script src="js/jquery.countdown.js"></script>
<script src="js/script.js"></script>

<!-- FlexSlider -->
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
  <script defer src="js/jquery.flexslider.js"></script>
  <script type="text/javascript">
	$(function(){
	  SyntaxHighlighter.all();
	});
	$(window).load(function(){
	  $('.flexslider').flexslider({
		animation: "slide",
		start: function(slider){
		  $('body').removeClass('loading');
		}
	  });
	});
  </script>
<!-- FlexSlider -->



<?php require_once './php/includes/footer.php'; ?>

<?php 
	if(isset($_POST['submit'])){
		$name = \filter_input(\INPUT_POST,'author');
		$email = \filter_input(\INPUT_POST,'email');
		$comment = \filter_input(\INPUT_POST,'comment');

		//validate data
		if(strlen($name)<2){
			echo "<script>alert('Your name is too short, enter an acceptable name');</script>";
            exit();
		}

		if(strlen($comment)<10){
			echo "<script>alert('Your name is too short, enter a reasonable comment');</script>";
            exit();
		}

		if(!Validation::v_email($email)){
			echo "<script>alert('please enter a valid email');</script>";
            exit();
		}

		//create the comment
		$theComment = new Comment();

		$theComment->name = htmlentities($name);
		$theComment->email = strip_tags($email);
		$theComment->datePosted = time();
		$theComment->projectId = htmlentities($projectDetails['id']);
		$theComment->comment= htmlentities($comment);
		$theComment->status = 0;
		$theComment->userId = htmlentities($projectDetails['userid']);

		if(($theComment->checkExistence())>0){
			echo "<script>alert('Comment already exist');</script>";
		}else{

		if($theComment->add()){
			echo "<script>alert('Comment posted successfully');</script>";
		}else{
			echo "<script>alert('Comment could not be posted due to an application error, please try again');</script>";
		}

		}

	}
 ?>

</body>
</html>

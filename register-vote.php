<?php
include('config.php');


	function test_input($data) 
									{
									  $data = trim($data);
									  $data = stripslashes($data);
									  $data = htmlspecialchars($data);
									  return $data;
									}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//validation
		$post_category=$sub_category=$phone=$email=$gender=$employment=$education=$home = '';
		$post_categoryErr=$sub_categoryErr=$phoneErr=$emailErr=$genderErr=$employmentErr=$educationErr=$homeErr = '';
					
					$post_category = $_REQUEST['post_category'];
					$sub_category = $_REQUEST['sub_category'];
					$phone = $_REQUEST['phone'];
					$email = $_REQUEST['email'];
					$gender = $_REQUEST['gender'];
					$employment = $_REQUEST['employment'];
					$education = $_REQUEST['education'];
					$home = $_REQUEST['home'];
					
					//post_category
					if (empty($_REQUEST['post_category']))
					{
						$post_categoryErr="This is Required";
					}
						else
					{
						$post_category = test_input($_REQUEST["post_category"]);
					
					}
					//sub-category
					if(empty($_REQUEST['sub_category'])){
						$sub_categoryErr = 'This field is required';
					}else{
						$sub_category = $_REQUEST['sub_category'];
					}
					//phone
					
					if(empty($_REQUEST['phone'])){
						$phoneErr = "Phone is Required";
					}else{
						if ((strlen($phone) <11) || (strlen($phone) > 11))
						{
							$phoneErr = "Phone must not be greater than or less 11 Characters ";	
						}
						
					}
					$phone = test_input($_REQUEST['phone']);
					//EMAIL
					if (empty($_REQUEST["email"])) 
					{
						$emailErr = "Email is required";
					} 
					else 
					{
						$email = test_input($_REQUEST["email"]);
						// check if e-mail address is well-formed
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
						{
						  $emailErr = "Invalid email format";
						}
					}
					//gender
					if(empty($_REQUEST['gender'])){
						$genderErr = "Gender is Required";
					}else{
						$gender =test_input($_REQUEST['gender']);
					}
					//employment
					if(empty($_REQUEST['employment'])){
						$employmentErr = "Employment is Required";
					}else{
						$employment =test_input($_REQUEST['employment']);
					}
					//education
					if(empty($_REQUEST['education'])){
						$educationErr = "Education is Required";
					}else{
						$education =test_input($_REQUEST['education']);
					}
					//Home
					if(empty($_REQUEST['home'])){
						$homeErr = "Home is Required";
					}else{
						$home =test_input($_REQUEST['home']);
					}
					//CHECKING FOR ERRORS IF THERE IS NOT ANY ERROR THAN THE FORM SHOULD BE SUBMITTED
					if(empty($post_categoryErr) && empty($sub_categoryErr) && empty($phoneErr) && empty($emailErr) && empty($genderErr) && empty($employmentErr) && empty($educationErr) && empty($homeErr)) 
						{
							//CHECKING FOR RECORD IF USER EXISTED		
									$query			=	"select * from register_vote where (email='$email') ";
									$rs		    	=	mysqli_query($conn,$query) or die(mysqli_error());
									$row		    =	mysqli_fetch_array($rs);
									if($row>0)
										{
											$message_Err = "Email Already Exist";
										}
										else
										{
										 	$query = "INSERT INTO register_vote (`state`,`city`,`mobile`,`email`,`gender`,`employment`,`education`,`home`) 
											values('$post_category','$sub_category','$phone','$email','$gender','$employment','$education','$home')";
											$rs=	mysqli_query($conn,$query) or die(mysqli_error());
												
											$message_success = "Vote Registered Successfully!";
										}
										
									
						}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register Vote</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php error_reporting(0);include('link.php'); ?>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select.country3").change(function(){
        var selectedCountry = $(".country3 option:selected").val();
        $.ajax({
            type: "POST",
            url: "process-request.php",
            data: { country3 : selectedCountry } 
        }).done(function(data){
            $("#response1").html(data);
        });
    });
});
</script>
</head>
<body>
<div class="container-fluid adding-scroll">
    <div class="row">
    <!--Left Side-->
        <?php include ('rightside.php'); ?>
        <!--Right Side-->
        <div class="col-xs-12 col-md-12 col-lg-6">
        	<?php include "navbar.php";?>
        	<div class="container">
            	<div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12 rightside-voteform">
					<?php if($message_Err!=""){echo '<p class="alert alert-danger">'.$message_Err.'</p>';}?>
					<?php if($message_success!=""){echo '<p class="alert alert-success">'.$message_success.'</p>';}?>
						<p> We go like kodinate awa sef, as we be yot now, make we vote person<br> wey ge us for mind. </p>
						<p>Plis join us, give us, as dey gada to oganise.</p>
						<form method="post">
							<div class="vote-form-settings">
								<p>I dey liv for </p>
									
								<select   name="post_category" class="form-control list-boxx country3"  required  placeholder="State">
													<option value="">Select Category</option>
													<?php include "config.php";
													$result = mysqli_query($conn,"SELECT * FROM states"); 
													while($row = mysqli_fetch_array($result)) {
														$category_id = $row['id'];
														$category_name = $row['state'];
														if($post_category == $_REQUEST['post_category']){$selectedd="selected";}
													?>
													
														<option value="<?php echo $category_id;?>" <?php echo $selectedd?>><?php echo $category_name;?></option>
														
													<?php
													}
													?>
											  </select> <br>
											  <?php if($post_categoryErr != ''){ ?><span> <?php echo $post_categoryErr ?></span><br><?php } ?>


								
								
							</div>
							<div class="vote-form-settings">
								<p>My City be </p>
								<select id="response1" name="sub_category" class="form-control list-boxx" required >
													<option value="">City</option>
											  </select><br>
											  <?php if($sub_categoryErr != ''){ ?><span> <?php echo $sub_categoryErr ?></span><br><?php } ?>
							</div>
							<div class="vote-form-settings">
								<p>Fone nomba </p>
								 <input type="text" name="phone" class="form-control"  placeholder="Mobile"><br>
								 <?php if($phoneErr != ''){ ?><span> <?php echo $phoneErr ?></span><br><?php } ?>
							</div>
							<div class="vote-form-settings">
								<p>Email be </p>
								 <input type="text" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Email"><br>
								 <?php if($emailErr != ''){ ?><span> <?php echo $emailErr ?></span><br><?php } ?>
							</div>
							<div class="vote-form-settings">
								<p>I be </p>
								<select id="response1" name="gender" class="form-control list-boxx" >
									<option value="">Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									<option value="Rather not say">Rather Not Say</option>
							  </select><br>
								<?php if($genderErr != ''){ ?><span> <?php echo $genderErr ?></span><br><?php } ?>
							</div>
							<div class="vote-form-settings">
								<p>Work </p>
								<select id="response1" name="employment" class="form-control list-boxx" >
									<option value="">Employment</option>
									<option value="Employed">Employed</option>
									<option value="Un-Employed">Un-Employed</option>
									<option value="Self-Employed">Self-Employed</option>
							  </select><br>
								<?php if($employmentErr != ''){ ?><span> <?php echo $employmentErr ?></span><br><?php } ?>
								
							</div>
							<div class="vote-form-settings">
								<p>Sku</p>
								<select id="response1" name="education" class="form-control list-boxx" >
									<option value="">School/Education</option>
									<option value="None">None</option>
									<option value="Primary">Primary</option>
									<option value="Secondary">Secondary</option>
									<option value="Other College">Other College</option>
									<option value="Polytechnic">Polytechnic</option>
									<option value="University">University</option>
							  </select><br>
								<?php if($educationErr != ''){ ?><span> <?php echo $educationErr ?></span><br><?php } ?> 
							</div>
							<div class="vote-form-settings">
								<p>Haos </p>
								<select id="response1" name="home" class="form-control list-boxx" >
									<option value="">Home/House</option>
									<option value="Homeless">Homeless</option>
									<option value="With Family">With Family</option>
									<option value="Live Alone">Live Alone</option>
									<option value="Own a Home">Own a Home</option>
									<option value="others">Others</option>
								</select><br><br>
								<?php if($homeErr != ''){ ?><span> <?php echo $homeErr ?></span><br><?php } ?>
							</div>
							<p id="vote-form-below-line">We go like take sid info konat you when time don rish<br> make we vote </p>
							<div class="vote-form-settings">
								 <button type="submit" class="btn btn-success btn-lg btn-block button-setting-vote">Submit</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
<!--Footer Start-->
<?php include('footer.php'); ?>

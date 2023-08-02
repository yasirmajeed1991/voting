<?php
	include('../config.php');
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['user_id'])){
		header('Location:login.php');
	}
	$universal_user_id = $_SESSION['user_id'];
	if($_SERVER["REQUEST_METHOD"]=="POST") 
		{
			
			$post_titleErr = $post_main_imgErr = $post_content_bodyErr = $post_quoteErr = $post_content_contErr = ""; 
			$post_title    = $post_main_img    = $post_content_body    = $post_quote = $post_content_cont = ""; 
             function test_input($data) 
			{
			 $data = trim($data);
			 $data = stripslashes($data);
			 $data = htmlspecialchars($data);
		     return $data;		
			}
			
			$post_title          =  $_REQUEST['post_title'];
			$post_main_img       =  $_REQUEST['post_main_img'];
			$post_content_body   =  $_REQUEST['post_content_body'];
			$post_quote          =  $_REQUEST['post_quote'];
			$post_content_cont   =  $_REQUEST['post_content_cont'];
		
				//post_title
				if (empty($_REQUEST['post_title']))
				{
					$post_titleErr="This is Required";
				}
				  else
				{
				    $post_title = test_input($_REQUEST["post_title"]);
					$post_title=preg_replace("/[^A-Za-z0-9 .]/", '', $post_title);
      			  if (!preg_match("/^[a-zA-Z-'0-9 ]*$/",$post_title)) 
				  {
                    $post_titleErr = "Only letters and white space allowed";
				  }
				  if(strlen($_REQUEST['post_title'])<70 && strlen($_REQUEST['post_title'])>150)
					{
						$post_titleErr = "This Field Must Contain At Least 100 to 150 Characters";
					}
				}
            	
				
        
				//post_content_body
				if (empty($_REQUEST['post_content_body']))
				{
					$post_content_bodyErr="This is Required";
				}
				  else
				{
				    $post_content_body = test_input($_REQUEST["post_content_body"]);
					$post_content_body=preg_replace("/[^A-Za-z0-9 .]/", '', $post_content_body);
     				 if(strlen($_REQUEST['post_content_body'])<100)
					{
						$post_content_bodyErr = "This Field Must Contain At Least 100 Characters";
					}
				}	

					//post_quote
				if (empty($_REQUEST['post_quote']))
				{
					$post_quoteErr="This is Required";
				}
				  else
				{
				    $post_quote = test_input($_REQUEST["post_quote"]);
			        $post_quote=preg_replace("/[^A-Za-z0-9 .]/", '', $post_quote);
				    if(strlen($_REQUEST['post_quote'])>300)
					{
						$post_quoteErr = "Quotes must be less than 300 characters";
					}
				}		

				//post_content_cont
				if (empty($_REQUEST['post_content_cont']))
				{
					$post_content_contErr="This is Required"; 
				}
				  else
				{
				    $post_content_cont = test_input($_REQUEST["post_content_cont"]);
					$post_content_cont=preg_replace("/[^A-Za-z0-9 .]/", '', $post_content_cont);
     				 if(strlen($_REQUEST['post_content_cont'])<100)
					{
						$post_content_contErr = "This Field Must Contain At Least 100 Characters";
					}
				}					
				//post_main_img
				if (isset($_REQUEST['post_main_img']))
				{
					$post_main_imgErr="This is Required"; 
				}
				else
				{
						// Set image placement folder
						$target_dir = "uploads/";
						// Get file path
						$filename = rand(10,100000). basename($_FILES["post_main_img"]["name"]);
						$post_main_img = $target_dir . $filename;     //Path of the file to be uploaded
						// Get file extension
						$imageExt = strtolower(pathinfo($post_main_img, PATHINFO_EXTENSION));
						// Allowed file types
						$allowd_file_ext = array("jpg", "jpeg", "png");
						

						if (!file_exists($_FILES["post_main_img"]["tmp_name"])) 
						{
						   $post_main_imgErr = "Select image to upload";
						   
						} 
						else if (!in_array($imageExt, $allowd_file_ext)) 
						{
							$post_main_imgErr = "Allowed file formats .jpg, .jpeg and .png.";
						            
						} 
						else if ($_FILES["post_main_img"]["size"] > 2097152) 
						{
							$post_main_imgErr =  "File is too large. File size should be less than 2 megabytes.";
						} 
						else if (file_exists($post_main_img)) 
						{
							
							$post_main_imgErr = "File already exists.";
							
						} 
						else 
						{
							$ok=1;
						}

							
				}
						
				if (isset($_REQUEST['post_1st_img']))
				{
					$post_1st_imgErr="This is Required"; 
				}
				else
				{
						
						// Set image placement folder
						$target_dir = "uploads/";
						// Get file path
						$filename = rand(10,100000). basename($_FILES["post_1st_img"]["name"]);
						$post_1st_img = $target_dir . $filename;     //Path of the file to be uploaded
						// Get file extension
						$imageExt = strtolower(pathinfo($post_1st_img, PATHINFO_EXTENSION));
						// Allowed file types
						$allowd_file_ext = array("jpg", "jpeg", "png");
						//post_1st_img
						
						if (!file_exists($_FILES["post_1st_img"]["tmp_name"])) 
						{
						   $post_1st_imgErr = "Select image to upload";
						   
						} 
						else if (!in_array($imageExt, $allowd_file_ext)) 
						{
							$post_1st_imgErr = "Allowed file formats .jpg, .jpeg and .png.";
						            
						} 
						else if ($_FILES["post_1st_img"]["size"] > 2097152) 
						{
							$post_1st_imgErr =  "File is too large. File size should be less than 2 megabytes.";
						} 
						else if (file_exists($post_1st_img)) 
						{
							
							$post_1st_imgErr = "File already exists.";
							
						} 
						else 
						{
							$ok=1;
						}	
				}
				
				if(empty($post_titleErr) && empty($post_main_imgErr) && empty($post_content_bodyErr) && empty($post_quoteErr) && empty($post_content_contErr))
				{
				
				move_uploaded_file($_FILES["post_main_img"]["tmp_name"], $post_main_img);
				$date_created= date ("F jS, Y");
				$date_updated = date ("F jS, Y");
		     	$query = "INSERT INTO blog (date_created,post_title,post_main_img,post_content_body,post_quote,post_content_cont,date_updated,post_created_by) 
				VALUES ('$date_created','$post_title','$post_main_img','$post_content_body','$post_quote','$post_content_cont','$date_updated','$universal_user_id')";
				mysqli_query($conn,$query) or die(mysqli_error());
				header("location:funtions.php?newpost=ok");
				}	





					
		
		}
	
	

?>
<?php
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Add Post 
            <!--
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
            </button>
			-->
    </h6>
  </div>
 <div class="card-body">

<?php if($_SESSION['message_success']!=""){echo '<p class="alert alert-success">'.$_SESSION['message_success'].'</p>';$_SESSION['message_success']='';}?>
<form method="post" enctype="multipart/form-data">
									<div class="row col">
										
											<input class="form-control " type="text" placeholder="Title" name="post_title" value="<?php echo $post_title?>" required>
										    <span class="error"> <?php echo $post_titleErr ?> </span>
									</div>
									
											
									

									<div class="blog_img top-buffer">
									
									 <!--   <img src="assets/images/blog_img1.jpg" alt="blog_img1">		-->
														Select Main image to upload:
														<input type="file" name="post_main_img"  required>
														
									</div><span class="error"> <?php echo $post_main_imgErr ?></span>
									
									<div class="row col top-buffer">
										
											<textarea class="form-control" name="post_content_body" value="<?php echo $post_content_body?>" placeholder="Content Body" rows="5" required><?php echo $post_content_body?></textarea>
										     <span class="error"><?php echo $post_content_bodyErr?></span>
									</div>
									
									<div class="row col top-buffer">
										<blockquote class="blockquote_style3">
											<textarea class="form-control" name="post_quote" placeholder="Quotes Not More Than 300 Characters" rows="2" value="<?php echo $post_quote?>" required><?php echo $post_quote?></textarea>
											<span class="error"><?php echo $post_quoteErr?></span>
										</blockquote>
									</div>
								
									<div class="blog_content">
										<div class="blog_text">
											<div class="row col top-buffer">
										
												<textarea class="form-control" name="post_content_cont" placeholder="Content Continue" rows="10" value="<?php echo $post_content_cont?>" required><?php echo $post_content_cont?></textarea>
										         
											</div ><span class="error"><?php echo $post_content_contErr?></span>
											<div class="top-buffer">
											<button  class="btn btn-fill-out" type="submit" target="_blank">Post Now!</button>
											</div>
										</div>
									</div>
								</div>
                </form>
</div>
</div>
</div>				
  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>				
<?php
	include('../config.php');
	error_reporting(0);
	session_start();
	if(!isset($_SESSION['user_id'])){
		header('Location:login.php');
	}

//Delete Data
if(isset($_GET['delete'])){
	$delet_vote = $_GET['delete'];
	$sql = "Delete FROM register_vote WHERE `id` = '$delet_vote'";
	$success = (mysqli_query($conn,$sql));
	
}


?>
<?php
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>

<!--
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	  
	  <form action="" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Your Name </label>
                <input type="text" name="your_name" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>


    </div>
  </div>
</div>
-->

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">All Posts 
            <!--
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
            </button>
			-->
    </h6>
  </div>

  <div class="card-body">
<?php if($_SESSION['message_success']!=""){echo '<p class="alert alert-success">'.$_SESSION['message_success'].'</p>';$_SESSION['message_success']='';}?>
    <div class="table-responsive">
	<?php
		$sql = "SELECT * FROM register_vote";
		$run = mysqli_query($conn,$sql);
	?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Post Title </th>
            <th>Post Content </th>
			<th>Edit </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
		<?php
		$sql = "SELECT * FROM blog";
		$run = mysqli_query($conn,$sql);
		while($fetch_voters = mysqli_fetch_assoc($run)){
			$state_id = $fetch_voters['state'];
			$string = strip_tags($fetch_voters['post_content_body']);
			if (strlen($string) > 150) 
			{
				// truncate string
				$stringCut = substr($string, 0, 150);
				$endPoint = strrpos($stringCut, ' ');
				//if the string doesn't contain any space then it will cut without word basis.
				$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
				
			}
		?>
	
          <tr>
            <td><?php echo ++$numbering ?> </td>
            <td><?php echo $fetch_voters['post_title']; ?></td>
            <td><?php echo $string; ?></td>
            
            
            <td>
                
                  <button type="submit" name="delete_btn" class="btn btn-success">
				  <a href="edit_blog.php?id=<?php echo $fetch_voters['id']; ?>" style="color: white; text-decoration: none;"> Edit</a></button>
                
            </td>
			<td>
                
                  <button type="submit" name="delete_btn" class="btn btn-danger">
				  <a href="funtions.php?del_post_id=<?php echo $fetch_voters['id']; ?>" style="color: white; text-decoration: none;"> DELETE</a></button>
                
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
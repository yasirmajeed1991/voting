<?php include "../config.php";
if (!empty($_GET['newpost']))
{
	session_start();
	$_SESSION['message_success']="Post Has Been Published Successfully!";
	header("location:blog.php");
}
if (!empty($_GET['updatepost']))
{
	session_start();
	$id=$_GET['updatepost'];
	$_SESSION['message_success']="Post Has Been Updated Successfully!";
	header("location:edit_blog.php?id=".$id."");
}
if (!empty($_GET['del_post_id']))
{	
	session_start();
	$id		=	$_GET['del_post_id'];
echo	$query	="Select * From blog where id = $id limit 1";
	$rs = mysqli_query($conn,$query);
	$row =	mysqli_fetch_array($rs);
	$imageUrl1 = $row['post_main_img'];
	 //check if image exists
  if(file_exists($imageUrl1))
  {
    //delete the image
    unlink($imageUrl1);
  }
  
	//after deleting image you can delete the record
    $query	="DELETE From blog where id = $id";
	$rs = mysqli_query($conn,$query);
	$_SESSION['message_success']="Post Has Been Deleted Successfully!";
	header("location:all_blog.php");
  
}

?>
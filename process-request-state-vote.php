<?php   error_reporting(0);
include "config.php";
if(isset($_POST["country"])){
    // Capture selected country value
    $country = $_POST["country"];
	if($country !== ''){
     $result = mysqli_query($conn,"SELECT * FROM   office where state_id =$country"); 
									while($row = mysqli_fetch_array($result)) 
									{
										
									
	 ?>
<option value="<?php echo $row['id'];?>"><?php echo $row['office'] ."-". $row['continuency'];?></option>
<?php	



}
    
	}
}
if(isset($_POST["country1"])){
    // Capture selected country value
    $country = $_POST["country1"];
	if($country1 !== ''){
     $result = mysqli_query($conn,"SELECT * FROM   office where id =$country"); 
	 $row = mysqli_fetch_array($result);


	 echo "We need <span> ".$row['votes_needed']." </span> votes"; 
								 
									
	 


 
    
	}
}

?>


<?php
include "config.php";
if(isset($_POST["country3"])){
    // Capture selected country value
    $country = $_POST["country3"];
	if($country !== ''){
     $result = mysqli_query($conn,"SELECT * FROM  cities where state_id =$country"); 
									while($row = mysqli_fetch_array($result)) 
									{
										
									
	 ?>
<option value="<?php echo $row['cities'];?>"><?php echo $row['cities'];?></option>
<?php	
}
    
	}
}
?>


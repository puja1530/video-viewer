<?php
include("connection.php");

if(isset($_POST['id'])){ //checking if section is set or not
	$id1=$_POST['id']; // Retriving the section value sent through sectionmapping.php code
	$query=mysqli_query($connect,"select  coursename from tblcourse where sectionid='$id1' "); //Selecting course value according to the section selected
	while ($row=mysqli_fetch_array($query)) {
		$courseid=$row['courseid'];
		$coursename=$row['coursename'];
		echo "<option value='$courseid'>$coursename</option>";  // Displaying in the option tag of course on the index.php page

		
	}
}
?>
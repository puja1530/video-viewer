<?php
	require 'connection.php'; // connecting to database
	if(isset($_POST['action'])){ // What action to take 
		$sql="Select videoLink from tblvideo where section !='' AND course !='' ";  //Retriving the video link
		if(isset($_POST['section'])){ 
			$section=implode("','", $_POST['section']);  //Seperating the array values sent by the ajax  code
			$sql.="AND section IN('".$section."')";
		}
		if(isset($_POST['course'])){
			$course=implode("','", $_POST['course']); //Seperating the array values sent by the ajax  code
			$sql.="AND course IN('".$course."')";
		}
		$result=$connect->query($sql);
		$output='';
		if($result->num_rows>0)
		{
			while($row=$result->fetch_assoc()){ //Displaying if result is present
				$output.='
			
				<div class="col-md-6 mb-2">  
			
				<embed><iframe style="width:500px; height:400px;" class="embed-responsive-item" src="https://www.youtube.com/embed/'.$row["videoLink"].'">
				
				</iframe> </embed>

				</div>';
			}
		} //End of if condition
		else{
			$output="<h3>No Videos Found</h3>"; // Storing the output message in a variable
		} //end of else
		echo $output; // Displaying the message
 	} // End of if condition
?>
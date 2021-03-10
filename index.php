<!--Calling the php database connection-->
<?php
include("connection.php");
?>


<!--Starting of html code for designing-->
<html>
<head>


<!--Linking the different scripts required-->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script  src="sectionmapping.js"></script>

</head>
<body>

<!--Heading -->
<h3 class="text-center text-light bg-info p-2"> Video Viewer</h3>
<hr>

<!--Form for inserting data  -->

<form class="form-horizontal" action='index.php' method="POST">
<div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
				<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
				<h2>Video Viewer</h2>
				<h4>Watch your saved youtube videos here</h4>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
			
			<div class="container mt-5 mb-5">
			<label>Section</label>
				<select name="section" class="form-control section selectFilter" id="sectionid">
				<option value="-1">Select Section</option>

				<!--For calling the section name from the database and mapping it to the course drop-down -->
				<?php 

    					$query=mysqli_query($connect,"select * from tblsection");
    					while ($row=mysqli_fetch_array($query)) { ?>

    						<option value ="<?php echo $row['sectionid']; ?> "> <?php echo $row['sectionname']; ?></option>
    			<?php 
    				}
    				?>
    				}
				</select>
				<br>
				<br>

				<!--Course options will be called from the database depending on section value -->

				<label>Course Id</label>
				<select name="course"  class="form-control course selectFilter"  id="courseid">
				<option value="">Select Course</option>
					
				</select>
			 
               </div>

				</div>

				<!-- Inserting video link-->
				<div class="form-group">
				  <label class="control-label col-sm-2" for="comment">Video Link :</label>
				  <div class="col-sm-10">
					<textarea class="form-control" rows="5" name="link"></textarea>
				  </div>
				</div>
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary" name="btnsubmit">Submit</button>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</form>

<!--End of form-->

<!--Starting php tag for form submission -->
<?php

if(isset($_POST['btnsubmit']) && !empty($_POST['section']) &&  !empty($_POST['course'])) //Checking whether all the fields is selected or not
{

			$section=$_POST['section'];
			$course=$_POST['course'];
			$link=$_POST['link'];
			$link=preg_replace("#.*youtube\.com/watch\?v=#","",$link); //Extracting only the video id and replacing it with the link


			$res=mysqli_query($connect,"INSERT INTO tblvideo (id,section,courseid,videoLink) values('','$section','$course','$link')"); //sql query for inserting the data into the databas


			if($res){ //checking if inserted successfully or not
				echo "<h5 alert alert-success>Inserted<h5>"; //showing the success message 
				header('Location:videoList.php'); //Redirecting to another page
			}
			else
			{
				echo "Something went wrong .Try Again!"; // Showing data not inserted 

			}

		
}
else
{
	echo"<h5 class='alert alert-danger'>Please fill all the details </h5>"; //Displaying a message to select all the value
}





?>

<!--End of php tag -->




</body>  <!-- End of body-->

</html><!-- End of html-->



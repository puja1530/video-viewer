<!--Calling the php database connection-->
<?php
include("connection.php");




?>
<!--Starting of html code for designing-->
<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
		
	</script>
	<script  src="sectionmapping.js"></script>
	










</head>
<!--Start of body tag-->
<body>
<h3 class="text-center text-light bg-info p-2"> Video List</h3> <!--Heading-->
<div class="container-fluid"> 
<div class="row">

<!--Div for filtering option-->
<div class="col-lg-3">
<h5>Filter Video</h5>
	<hr>
	<h6 class="text-info">Select Section</h6>  <!--Showing all the section from database-->
	<ul class="list-group">

	<!--Php code for retrieving sectionname from databse-->
	<?php 

		$sql="SELECT sectionname from tblsection";
		$res=$connect->query($sql);
		while ($row=$res->fetch_assoc()) { ?>






			<li class="list-group-item">
			<div class="form-check">
				<label class="form-check-label">
					<input id="section" type="checkbox" class="form-check-input video_check" value="<?php echo $row['sectionname']; ?>" > 
					<?php echo $row['sectionname']; ?>
				</label>
			</div>
				
			</li>
			
		<?php } ?>


<!--End of php tage-->
		
	</ul>

	<!--End of Section List-->
	<!--Start of course listn-->
	<h6 class="text-info">Select Course</h6>
	<ul class="list-group">

	<!--Php code for retrieving courseid from databse-->

	<?php 

		$sql="SELECT coursename from tblcourse";
		$res=$connect->query($sql);
		while ($row=$res->fetch_assoc()) { ?>






			<li class="list-group-item">
			<div class="form-check">
				<label class="form-check-label">
					<input id="course" type="checkbox" class="form-check-input video_check" value="<?php echo $row['coursename']; ?>"> 
					<?php echo $row['coursename']; ?>
				</label>
			</div>
				
			</li>
			
		<?php } ?>
		<!--End of php tage-->



		
	</ul>
	<!--End of Section List-->
	
</div>

<!--End of Filter section-->

<!--Start of video list-->
<div class="col-lg-9" >
<h5 class="text-center" id="textChange">All Videos</h5> 
<hr>
<div class="text-center">
<div class="row"  id="result">

<!--Php tag for retrieving the video links from the database -->
	<?php 
		$sql2="Select videoLink from tblvideo";
		$result2=$connect->query($sql2);
		while($row1=$result2->fetch_assoc()){ ?>

			<div class="col-md-6 mb-2">
			
			<embed><iframe style="width:500px; height:400px;" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $row1["videoLink"];?>">
				
			</iframe> </embed> <!--Embeding the link -->

			</div>

		

		<?php 
			}


	?>

	<!--End of Php tag -->
</div>
	

</div>



<!--Start of scrip for showing the videos according to the section and course selected-->

<script type="text/javascript">
	$(document).ready(function(){
		$(".video_check").click(function(){  
			var action='data';
			var section=get_filter_text('section');
			var course=get_filter_text('course');
			
			$.ajax({
				url:'filter.php',
				method:'POST',
				data:{action:action,section:section,course:course},
				success:function(response){
					$("#result").html(response);
					$("#textChange").text("Filtered Videos");
				}
			});
			
		});

		function get_filter_text(text_id)
		{
			var filterData=[];

			$('#'+text_id+':checked').each(function(){
				filterData.push($(this).val());
				//alert ("hello");

			});
			return filterData;
		}
	});
</script>

<!--End of scrip tag -->


</body> <!--End of body tag -->
</html> <!--End of html tag -->
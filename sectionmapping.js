$(document).ready(function(){
	         		$("#sectionid").on('change',function(){ //When any section is selected change event is called
							var sectionId=$(this).val(); // Keeping the section value in a variable
							$.ajax({						// Sending the section value to ajax.php page for dynamiclly changing the value of course id
								method:"POST",
								url:"ajax.php",
								data:{id:sectionId},
								dataType:"html",
								success:function(data){
									$("#courseid").html(data);
								}
							});
				
					});

			

});
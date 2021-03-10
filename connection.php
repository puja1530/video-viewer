<?php
$connect=mysqli_connect("localhost","root","","videoviewer"); //Connecting to database server
if($connect->connect_error)
{
	die("Connection failed :".$connect->connect_error);
}






?>
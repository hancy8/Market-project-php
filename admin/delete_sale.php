<?php
include("connection.php");

session_start();
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$sale_id=$_GET['id'];

	$sql=mysqli_query($conn, "DELETE FROM sales WHERE sale_id='$sale_id'");
	

if($sql)
{
	echo "Delete Successful!";
}

else
{
	echo "Error! Delete was Unsuccessful.";
}
?>

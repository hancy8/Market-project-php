<?php
include("connection.php");

session_start();
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$purchase_id=$_GET['id'];

	$sql=mysqli_query($conn, "DELETE FROM purchase_details WHERE purchase_id='$purchase_id'");
	
	$sql=mysqli_query($conn, "DELETE FROM purchases WHERE purchase_id='$purchase_id'");

if($sql)
{
	echo "Delete Successful!";
}

else
{
	echo "Error! Delete was Unsuccessful.";
}

// }
<?php
include("connection.php");

session_start();
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$supplier_id=$_GET['id'];


	$sql=mysqli_query($conn, "DELETE FROM supplier_payment WHERE invoice='$supplier_id'");

if($sql)
{
	echo "Delete Successful!";
	echo "<script> location='suppliers_payment.php'; </script>";
}

else
{
	echo "Error! Delete was Unsuccessful.";
}

// }
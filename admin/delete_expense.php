<?php
include("connection.php");

session_start();
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$sale_id=$_GET['id'];

	$sql=mysqli_query($conn, "DELETE FROM expanse WHERE exp_id='$sale_id'");
	

if($sql)
{
	echo "<script> alert('Record DELETE Successfully!'); </script>";
	echo "<script> location='expense.php'; </script>";

}

else
{
	echo "Error! Delete was Unsuccessful.";
	echo "<script> location='expense.php'; </script>";
}
?>

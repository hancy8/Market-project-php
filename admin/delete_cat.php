<?php
include("connection.php");

session_start();
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$cat_id=$_GET['id'];


/* $get_product=mysqli_query($conn, "SELECT * FROM products WHERE id='$pro_id'");

while($row=mysqli_fetch_array($get_product))
{
	$image_file='../images/products/'.$row['product_image1'];
}

if(file_exists($image_file)) 
{
	
    unlink($image_file); */

	$sql=mysqli_query($conn, "DELETE FROM product_cats WHERE cat_id='$cat_id'");

if($sql)
{
	echo "Delete Successful!";
}

else
{
	echo "Error! Delete was Unsuccessful.";
}

// }
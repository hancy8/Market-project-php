<?php


include("header_manager.php");


$pro_id=$_GET['id'];


/* $get_product=mysqli_query($conn, "SELECT * FROM products WHERE id='$pro_id'");

while($row=mysqli_fetch_array($get_product))
{
	$image_file='../images/products/'.$row['product_image1'];
}

if(file_exists($image_file)) 
{
	
    unlink($image_file); */

	//Delete all categories of this product
	$sql=mysqli_query($conn, "DELETE FROM product_cats WHERE product_id='$pro_id'");
	
	//Delete the actual product
	$sql=mysqli_query($conn, "DELETE FROM products WHERE product_id='$pro_id'");	 


if($sql)
{
	echo "Delete Successful!";
}

else
{
	echo "Error! Delete was Unsuccessful.";
}

// }
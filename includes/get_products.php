<?php

include("connection.php");

$purchase_id=$_GET['id'];
$supplier_id=$_GET['sup'];

// $newArray = array();

$getpurchases=mysqli_query($conn, "SELECT DISTINCT b.product_id FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE a.purchase_id='$purchase_id' && b.supplier_id='$supplier_id'");

// $get_trucks=mysqli_fetch_array($getcats);

$i=0;

$count=mysqli_num_rows($getpurchases);

if($count>0)
{
while($get_purchases=mysqli_fetch_array($getpurchases))
{
	
	$product_id=$get_purchases['product_id'];
	
	$getpro=mysqli_query($conn, "SELECT * FROM products WHERE product_id='$product_id'");
	while($pro=mysqli_fetch_array($getpro))
	{
		$product_name=$pro['product_name'];
	}
	
	// echo '<option value="' . $get_cats['cat_id'] . '">' . $get_cats['cat_name'] . '</option>';
	
	$my_array[$i]['product_id'] = $product_id;
	$my_array[$i]['product_name'] = $product_name;
	$i++;
	
}

$list=json_encode($my_array);

echo $list;

}
else
{
	echo "";
}
// print_r($my_array);

?>
<?php

include("connection.php");

$pro_id=$_GET['id'];

// $newArray = array();

$getcats=mysqli_query($conn, "SELECT * FROM product_cats WHERE product_id='$pro_id'");

// $get_cats=mysqli_fetch_array($getcats);

$i=0;

$count=mysqli_num_rows($getcats);

if($count>0)
{
while($get_cats=mysqli_fetch_array($getcats))
{
	
	// echo '<option value="' . $get_cats['cat_id'] . '">' . $get_cats['cat_name'] . '</option>';
	
	$my_array[$i]['cat_id'] = $get_cats['cat_id'];
	$my_array[$i]['cat_name'] = $get_cats['cat_name'];
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
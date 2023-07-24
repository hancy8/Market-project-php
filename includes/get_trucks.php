<?php

include("connection.php");

$supplier_id=$_GET['id'];

// $newArray = array();

$gettrucks=mysqli_query($conn, "SELECT DISTINCT a.purchase_id, a.truck_id FROM purchases as a INNER JOIN purchase_details as b ON a.purchase_id=b.purchase_id WHERE a.status='open' && b.supplier_id='$supplier_id'");

// $get_trucks=mysqli_fetch_array($getcats);

$i=0;

$count=mysqli_num_rows($gettrucks);

if($count>0)
{
while($get_trucks=mysqli_fetch_array($gettrucks))
{
	
	// echo '<option value="' . $get_cats['cat_id'] . '">' . $get_cats['cat_name'] . '</option>';
	
	$my_array[$i]['purchase_id'] = $get_trucks['purchase_id'];
	$my_array[$i]['truck_id'] = $get_trucks['truck_id'];
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
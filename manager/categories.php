<?php

include("header_manager.php");

$product_id=$_GET['id'];
$product_name=$_GET['name'];

$sql=mysqli_query($conn, "SELECT * FROM product_cats WHERE product_id='$product_id'");

?>

<div class="container">

<div>
<h3><?php echo $product_name; ?> Categories</h3>

<br>
<div class="row">
<div class="col-sm-3">
<?php echo '<a href="add_cat.php?id='.$product_id.'&name='.$product_name.'">'; ?><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Name</th><th>Description</th><th>Action</th>
</tr>

<?php

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='4' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$cat_id=$select['cat_id'];
	$cat_name=$select['cat_name'];
	$cat_description=$select['cat_description'];
	$status=$select['status'];
	
	// $img = "../images/customers/" . $pro_img;
	
echo "
<tr id='$cat_id'>
<td>".$cat_id."</td>
<td>".$cat_name."</td>
<td>".$cat_description."</td>
<td><a href='edit_cat.php?id=$cat_id&proid=$product_id&proname=$product_name'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='#' onclick='catdel($cat_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";

}

}
?>

</table>
</div>

</div>
</body>

<?php
//include('footer_admin.php');
?>
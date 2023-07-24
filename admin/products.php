<?php

session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

$user=$_SESSION['user'];

include("header_admin.php");

?>

<div class="container">

<div>
<h3>Products Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<?php echo '<a href="add_product.php">'; ?><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Name</th><th>Description</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM products");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='4' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$product_id=$select['product_id'];
	$name=$select['product_name'];
	$description=$select['product_description'];
	$status=$select['status'];
	
	// $img = "../images/customers/" . $pro_img;
	
echo "
<tr id='$product_id'>
<td><a href='categories.php?id=$product_id&name=$name'>".$product_id."</a></td>
<td><a href='categories.php?id=$product_id&name=$name'>".$name."</a></td>
<td><a href='categories.php?id=$product_id&name=$name'>".$description."</a></td>
<td><a href='edit_product.php?id=$product_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='#' onclick='productdel($product_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";

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
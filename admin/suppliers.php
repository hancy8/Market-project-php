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
<h3>Suppliers Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<?php echo '<a href="add_supplier.php">'; ?><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Name</th><th>Address</th><th>Phone</th><th>Products</th><th>Added On</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM suppliers");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='7' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$supplier_id=$select['supplier_id'];
	$name=$select['supplier_name'];
	$address=$select['supplier_address'];
	$phone=$select['supplier_phone'];
	$products=$select['products'];
	$date=$select['date_added'];
	$status=$select['status'];
	
	// $img = "../images/customers/" . $pro_img;
	
echo "
<tr id='$supplier_id'>
<td>".$supplier_id."</td>
<td>".$name."</td>
<td>".$address."</td>
<td>".$phone."</td>
<td>".$products."</td>
<td>".$date."</td>
<td><a href='edit_supplier.php?id=$supplier_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='#' onclick='supplierdel($supplier_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";
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
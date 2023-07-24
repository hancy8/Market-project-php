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
<h3>Managers Management</h3>

<br>
<div class="row">
<div class="col-sm-3">
<?php echo '<a href="add_manager.php">'; ?><div class="btn btn-default">Add New</div></a>
</div>
</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Name</th><th>Address</th><th>Phone</th><th>Stock</th><th>Customers</th><th>Suppliers</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM managers");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='8' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

while($select=mysqli_fetch_array($sql))
{
	$manager_id=$select['manager_id'];
	$name=$select['manager_name'];
	$address=$select['manager_address'];
	$phone=$select['manager_phone'];
	$salary=$select['manager_salary'];
	$user=$select['manager_username'];
	$pass=$select['manager_password'];
	$stock=$select['stock_access'];
	$customer=$select['customer_access'];
	$supplier=$select['supplier_access'];
	$status=$select['status'];
	
	// $img = "../images/customers/" . $pro_img;
	
echo "
<tr id='$manager_id'>
<td>".$manager_id."</td>
<td>".$name."</td>
<td>".$address."</td>
<td>".$phone."</td>
<td>"; if($stock==1) {echo "Allowed";} else {echo "Denied";} echo "</td>
<td>"; if($customer==1) {echo "Allowed";} else {echo "Denied";} echo "</td>
<td>"; if($supplier==1) {echo "Allowed";} else {echo "Denied";} echo "</td>
<td><a href='edit_manager.php?id=$manager_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='#' onclick='managerdel($manager_id)'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>";
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
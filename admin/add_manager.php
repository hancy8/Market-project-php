<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Manager</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Manager Name</label>
<input type="text" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" class="form-control" name="phone" />
</div>

<div class="form-group">
<label for="address">Address</label>
<input type="text" class="form-control" name="address" />
</div>

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username" />
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="text" class="form-control" name="password" />
</div>

<div class="form-group">
  <label for="stock_access">Stock Access</label>
  <select class="form-control" name="stock_access">
    <option value="1">Grant</option>
    <option value="0" selected>Deny</option>
  </select>
</div>

<div class="form-group">
  <label for="customer_access">Customers Access</label>
  <select class="form-control" name="customer_access">
    <option value="1">Grant</option>
    <option value="0" selected>Deny</option>
  </select>
</div>

<div class="form-group">
  <label for="product_access">Supplier Access</label>
  <select class="form-control" name="supplier_access">
    <option value="1">Grant</option>
    <option value="0" selected>Deny</option>
  </select>
</div>

<button class="btn btn-primary" name="add">Add</button>&nbsp;<button class="btn btn-default" name="cancel">Cancel</button>
</form>
</div>
</div>

</div>


</body>


<?php

if(isset($_POST['add']))
{
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$user=$_POST['username'];
	$pass=$_POST['password'];
	$stock_access=$_POST['stock_access'];
	$customer_access=$_POST['customer_access'];
	$supplier_access=$_POST['supplier_access'];
	
	/* echo $name, $phone, $address, $user, $pass, $stock_access, $customer_access, $product_access;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO managers(manager_name, manager_address, manager_phone, manager_username, manager_password, stock_access, customer_access, supplier_access, status) VALUES('$name', '$address', '$phone', '$user', '$pass', '$stock_access', '$customer_access', '$supplier_access', '1')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='managers.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='managers.php'; </script>";
}
?>
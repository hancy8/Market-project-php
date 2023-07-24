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
<div class="panel-heading"><h3>Adding New Salesman</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Salesman Name</label>
<input type="text" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="address">Address</label>
<textarea class="form-control" name="address"></textarea>
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" class="form-control" name="phone" />
</div>
<div class="form-group">
<label for="Salary">Salary</label>
<input type="number" class="form-control" name="salary" />
</div>
<div class="form-group">
<label for="user">Username</label>
<input type="text" class="form-control" name="username" />
</div>

<div class="form-group">
<label for="pass">Password</label>
<input type="text" class="form-control" name="password" />
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
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$user=$_POST['username'];
	$pass=$_POST['password'];
	$date=date("d-m-Y");
	$salery=$_POST['salary'];
	/* echo $name, $address, $phone, $user, $pass, $date;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO salesmen(salesman_name, salesman_address, salesman_phone, salesman_username, salesman_password, date_created, status,salary) VALUES('$name', '$address', '$phone', '$user', '$pass', '$date', '1','$salery')");
		
		
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='salesmen.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='salesmen.php'; </script>";
}

?>
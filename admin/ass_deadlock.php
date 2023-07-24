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
<div class="panel-heading"><h3>Adding New DeadLock</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Expanse Name</label>
<input type="text" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="Salary">Amount</label>
<input type="number" class="form-control" name="salary" />
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
	$date=date("Y/m/d");
	$salery=$_POST['salary'];
	/* echo $name, $address, $phone, $user, $pass, $date;
	die(); */

$sql=mysqli_query($conn, "INSERT INTO `deadlock` (`id`, `name`, `amount`, `date`) VALUES (NULL, '$name', '$salery', '$date')");
		
		
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='deadlock.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='deadlock.php'; </script>";
}

?>
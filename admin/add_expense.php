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
<div class="panel-heading"><h3>Adding New Expense</h3></div>
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
<div class="form-group">
<label for="user">Paid_by</label>
<input type="text" class="form-control" name="username" />
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
    $user=$_POST['username'];
	$date=date("Y/m/d");
	$salery=$_POST['salary'];
	/* echo $name, $address, $phone, $user, $pass, $date;
	die(); */

$sql=mysqli_query($conn, "INSERT INTO `expanse` (`exp_name`, `exp_date`, `amount`, `paid_by`) VALUES ('$name', '$date', '$salery', '$user')");
		
		
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='expense.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='expense.php'; </script>";
}

?>
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
<div class="panel-heading"><h3>Adding New Product</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Product Name</label>
<input type="text" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="phone">Description</label>
<textarea class="form-control" name="description"></textarea>
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
	$description=$_POST['description'];
	
	/* echo $name, $description;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO products(product_name, product_description, status) VALUES('$name', '$description', '1')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='products.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='products.php'; </script>";
}

?>
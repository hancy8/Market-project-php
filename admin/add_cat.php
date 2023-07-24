<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$product_id=$_GET['id'];
$product_name=$_GET['name'];

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding <?php echo $product_name; ?>'s New Category</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Category Name</label>
<input type="text" class="form-control" name="name" />
</div>

<input type="hidden" class="form-control" value="<?php echo $product_id; ?>" name="productid" />
<input type="hidden" class="form-control" value="<?php echo $product_name; ?>" name="productname" />

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
	$product_id=$_POST['productid'];
	$product_name=$_POST['productname'];
	
	/* echo $name, $description, $product_id, $product_name;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO product_cats(cat_name, product_id, cat_description, status) VALUES('$name', '$product_id', '$description', '1')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='categories.php?id=".$product_id."&name=".$product_name."'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='products.php'; </script>";
}

?>
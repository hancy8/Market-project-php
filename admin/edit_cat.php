<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$product_id=$_GET['proid'];
$product_name=$_GET['proname'];
$cat_id=$_GET['id'];

$sql=mysqli_query($conn, "SELECT * FROM product_cats WHERE cat_id='$cat_id'");

while($select=mysqli_fetch_array($sql))
{

	$name=$select['cat_name'];
	$description=$select['cat_description'];
	$status=$select['status'];
}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Editing Product Category</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Category Name</label>
<input type="text" value="<?php echo $name; ?>" class="form-control" name="name" />
</div>

<input type="hidden" class="form-control" value="<?php echo $product_id; ?>" name="productid" />
<input type="hidden" class="form-control" value="<?php echo $product_name; ?>" name="productname" />

<div class="form-group">
<label for="phone">Description</label>
<textarea class="form-control" name="description"><?php echo $description; ?></textarea>
</div>


<button class="btn btn-primary" name="update">Update</button>&nbsp;<button class="btn btn-default" name="cancel">Cancel</button>
</form>
</div>
</div>

</div>


</body>


<?php

if(isset($_POST['update']))
{
	$name=$_POST['name'];
	$description=$_POST['description'];
	$product_id=$_POST['productid'];
	$product_name=$_POST['productname'];
	
	/* echo $name, $description;
	die(); */

		$sql=mysqli_query($conn, "UPDATE product_cats SET cat_name='$name', cat_description='$description' WHERE cat_id='$cat_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='categories.php?id=".$product_id."&name=".$product_name."'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='categories.php?id=".$product_id."&name=".$product_name."'; </script>";
}

?>
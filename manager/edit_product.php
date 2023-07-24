<?php

include("header_manager.php");

$product_id=$_GET['id'];

$sql=mysqli_query($conn, "SELECT * FROM products WHERE product_id='$product_id'");

while($select=mysqli_fetch_array($sql))
{

	$name=$select['product_name'];
	$description=$select['product_description'];
	$status=$select['status'];
}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Editing Product</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Product Name</label>
<input type="text" value="<?php echo $name; ?>" class="form-control" name="name" />
</div>

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
	
	/* echo $name, $description;
	die(); */

		$sql=mysqli_query($conn, "UPDATE products SET product_name='$name', product_description='$description' WHERE product_id='$product_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='products.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='products.php'; </script>";
}

?>
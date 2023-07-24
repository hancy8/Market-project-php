

<!DOCTYPE html>
<html>
<head>
	<title>Edit Truck</title>
	<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");
include("../includes/functions.php");

$purchase_id=$_GET['id'];
$purchases_id=$_GET['p_id'];
$status=$_GET['status'];
$sql=mysqli_query($conn, "SELECT * FROM purchase_details WHERE purchase_detail_id='$purchase_id'");
while($select=mysqli_fetch_array($sql))
{
	
	 $purid=$select['purchase_detail_id'];
	$suppid=$select['supplier_id'];
	$proid=$select['product_id'];
	$catid=$select['cat_id'];
	$qty=$select['quantity'];

	
	/* Get Supplier */
	$sup_name=getSupplier($suppid);
	
	/* Get Product */
	$pro_name=getProduct($proid);
	
	/* Get Category */
	if($catid!=='0')
	{
		$cati_name=getCategory($catid);
	}
	else
	{
		$cat_name='';
	}
	
}
 

?>
</head>
<body>
<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding Purchase Details</h3></div>
<div class="panel-body">
<form method="post" name="add_purchase_details_form" enctype="multipart/form-data">

<div class="form-group">
<label for="supplier">Supplier</label>
<select class="form-control" name="supplier">
<option value="" disabled >Select Supplier</option>
<?php
$get_supplier=mysqli_query($conn, "SELECT * FROM suppliers");
while($supplier=mysqli_fetch_array($get_supplier))
{
	$supplier_id=$supplier['supplier_id'];
	$supplier_name=$supplier['supplier_name'];
	if ($supplier_name==$sup_name) {
		echo '<option selected value="'.$supplier_id.'">'.$supplier_name.'</option>';
	}
	else
	{
		echo '<option  value="'.$supplier_id.'">'.$supplier_name.'</option>';
	}
	
	
}
?>

</select>
</div>

<div class="form-group">
<label for="product">Product</label>
<select class="form-control" id="product" onchange="get_product_cats()" name="product">
<option value="" disabled selected>Select Product</option>

<?php
$get_product=mysqli_query($conn, "SELECT * FROM products");
while($product=mysqli_fetch_array($get_product))
{
	$product_id=$product['product_id'];
	$product_name=$product['product_name'];
	if($product_name==$pro_name)
	{
	echo '<option selected value="'.$product_id.'">'.$product_name.'</option>';
	}
	else{
		echo '<option  value="'.$product_id.'">'.$product_name.'</option>';
	}
}
?>

</select>
</div>

<div class="form-group">
<label for="rent">Product Category</label>
<select class="form-control" id="product" name="cat">
<option value="" disabled selected>Select Category</option>
<?php

$get_cat=mysqli_query($conn, "SELECT * FROM product_cats");
while($cat=mysqli_fetch_array($get_cat))
{
	$cat_id=$cat['cat_id'];
	$cat_name=$cat['cat_name'];
	if ($cat_name==$cati_name) {
		echo '<option selected value="'.$cat_id.'">'.$cat_name.'</option>';

	}
	else{
		echo '<option value="'.$cat_id.'">'.$cat_name.'</option>';

	}
		
}
?>

</select>
</div>

<div class="form-group">
<label for="quantity">Quantity</label>
<input type="number" class="form-control" value="<?php echo $qty?>" name="quantity" />
</div>


<button   class="btn btn-primary" name="add">Edit</button>&nbsp;<button class="btn btn-default" name="cancel">Cancel</button>

</div>
</div>

</div>
</form>
</div>
</div>
</div>

</body>
</html>

<?php 

if(isset($_POST['add']))
{
	$supplier=$_POST['supplier'];
	$product=$_POST['product'];
	$cat=$_POST['cat'];
	$qty=$_POST['quantity'];
		$sql=mysqli_query($conn, "UPDATE purchase_details SET supplier_id='$supplier', product_id='$product',cat_id='$cat',quantity='$qty' WHERE purchase_detail_id='$purchase_id' ");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='add_purchase_details.php?id=".$purchases_id."'; </script>";
			
		}

/*else{
	       echo "<script> alert('Status is closed You are No able to Edit'); </script>";
			echo "<script> location='add_purchase_details.php?id=".$purchases_id."'; </script>";
}*/
	
}

 ?>
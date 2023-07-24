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

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding Purchase Details</h3></div>
<div class="panel-body">
<form method="post" name="add_purchase_details_form" enctype="multipart/form-data">

<div class="form-group">
<label for="supplier">Supplier</label>
<select class="form-control" name="supplier">
<option value="" disabled selected>Select Supplier</option>
<?php
$get_supplier=mysqli_query($conn, "SELECT * FROM suppliers");
while($supplier=mysqli_fetch_array($get_supplier))
{
	$supplier_id=$supplier['supplier_id'];
	$supplier_name=$supplier['supplier_name'];
	
	echo '<option value="'.$supplier_id.'">'.$supplier_name.'</option>';
	
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
	
	echo '<option value="'.$product_id.'">'.$product_name.'</option>';
	
}
?>

</select>
</div>

<div class="form-group">
<label for="rent">Product Category</label>
<select class="form-control" id="product" name="cat" >
<option value="" disabled selected>Select Category</option>
<?php

$get_cat=mysqli_query($conn, "SELECT * FROM product_cats");
while($cat=mysqli_fetch_array($get_cat))
{
	$cat_id=$cat['cat_id'];
	$cat_name=$cat['cat_name'];
	
	echo '<option value="'.$cat_id.'">'.$cat_name.'</option>';
	
}
?>

</select>
</div>

<div class="form-group">
<label for="quantity">Quantity</label>
<input type="number" class="form-control" name="quantity" />
</div>


<button class="btn btn-primary" name="add">Add</button>&nbsp;<button class="btn btn-default" name="cancel">Cancel</button>

</div>
</div>

</div>
<br>

<table class="table table-striped table-bordered">
<tr>
<th>ID</th><th>Supplier</th><th>Product</th><th>Category</th><th>Quantity</th><th>Status</th><th>Action</th>
</tr>

<?php

$sql=mysqli_query($conn, "SELECT * FROM purchase_details WHERE purchase_id='$purchase_id' && status='open'");

$count=mysqli_num_rows($sql);

if($count==0)
{
	echo "<tr><td colspan='5' style='text-align:center;'>No Record Found</td></tr>";
}
else
{	

$i=0;

while($select=mysqli_fetch_array($sql))
{
	
	$i=$select['purchase_detail_id'];
	// $purid=$select['purchase_id'];
	$suppid=$select['supplier_id'];
	$proid=$select['product_id'];
	$catid=$select['cat_id'];
	$qty=$select['quantity'];
    $status=$select['status'];
	
	/* Get Supplier */
	$sup_name=getSupplier($suppid);
	
	/* Get Product */
	$pro_name=getProduct($proid);
	
	/* Get Category */
	if($catid!=='0')
	{
		$cat_name=getCategory($catid);
	}
	else
	{
		$cat_name='';
	}
	
	
echo "
<tr>
<td>".$i."</td>
<td>".$sup_name."</td>
<td>".$pro_name."</td>
<td>".$cat_name."</td>
<td>".$qty."</td>
<td>".$status."</td>
<td colspan='2'><a href='edit_truck.php?id=$i &status=$status &p_id=$purchase_id'><div class='btn btn-primary btn-sm'> Edit </div></a>&nbsp;<a href='delete_truck.php?id=$i & ids=$purchase_id'><div class='btn btn-danger btn-sm'> Delete </div></a></td></tr>
</tr>";

}

}
?>
<tr><td colspan="7" style="text-align:center;"><button class="btn btn-success" name="save">Save</button></td></tr>
</table>
</form>

</body>


<?php

if(isset($_POST['add']))
{
	$supplier=$_POST['supplier'];
	$product=$_POST['product'];
	$cat=$_POST['cat'];
	$qty=$_POST['quantity'];
	
	
	/* echo $purchase_id, $supplier, $product, $cat, $qty;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO purchase_details(purchase_id, supplier_id, product_id, cat_id, quantity,status) VALUES('$purchase_id', '$supplier', '$product', '$cat', '$qty','open')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
			
		}
	
		else
		{
			// echo "<script> alert('Record Added Successfully!'); </script>";
			echo "<script> location='add_purchase_details.php?id=".$purchase_id."'; </script>";
			
		}

	
}

if(isset($_POST['save']))
{
	echo "<script> location='add_purchase.php'; </script>";
}

?>
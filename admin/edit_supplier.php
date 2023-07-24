<?php
session_start();

include("connection.php");

if(!isset($_SESSION['user']))
{
	header('location:index.php');
}

include("header_admin.php");

$supplier_id=$_GET['id'];

$sql=mysqli_query($conn, "SELECT * FROM suppliers WHERE supplier_id='$supplier_id'");

while($select=mysqli_fetch_array($sql))
{
	$name=$select['supplier_name'];
	$address=$select['supplier_address'];
	$phone=$select['supplier_phone'];
	$products=$select['products'];
	$date=$select['date_added'];
	$status=$select['status'];	
}

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Editing Supplier</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Supplier Name</label>
<input type="text" value="<?php echo $name; ?>" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" value="<?php echo $phone; ?>" class="form-control" name="phone" />
</div>

<div class="form-group">
<label for="address">Address</label>
<input type="text" value="<?php echo $address; ?>" class="form-control" name="address" />
</div>

<div class="form-group">
<label for="address">Added On</label>
<input type="date" value="<?php echo $date; ?>" class="form-control" name="date" disabled />
</div>

<div class="form-group input-group">
<label for="username">Products</label><br>
<input type="text" class="form-control" value="<?php echo $products; ?>" name="products" id="tags-input-products" placeholder="Type Products Here.." data-role="tagsinput" />
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
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$products=$_POST['products'];
	
	/* echo $name, $phone, $address, $products;
	die(); */

		$sql=mysqli_query($conn, "UPDATE suppliers SET supplier_name='$name', supplier_address='$address', supplier_phone='$phone', products='$products' WHERE supplier_id='$supplier_id'");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Updated Successfully!'); </script>";
			echo "<script> location='suppliers.php'; </script>";
		}

	

}

if(isset($_POST['cancel']))
{
	echo "<script> location='suppliers.php'; </script>";
}

?>

<!-- Typeahead for multiple inputs -->
<script src="../js/typeahead.js"></script>
<script src="../js/bootstrap-tagsinput.js"></script>
<script>
	
	// $(':checkbox').checkboxpicker();
	
		var products = new Bloodhound({
		  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  prefetch: {
			url: '../data/dynamic_products_list.php',
			/* url: '../data/products_list.json', */
			filter: function(list) {
			  return $.map(list, function(name) {
				return { name: name }; });
			}
		  }
		});
		products.initialize();

		$('#tags-input-products').tagsinput({
		  typeaheadjs: {
			name: 'products',
			displayKey: 'name',
			valueKey: 'name',
			source: products.ttAdapter()
		  }
		});
	</script>
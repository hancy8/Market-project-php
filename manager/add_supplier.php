<?php


include("header_manager.php");

?>


<div class="container">

<br><br>

<div class="panel panel-primary" style="width:400px; margin:auto;">
<div class="panel-heading"><h3>Adding New Supplier</h3></div>
<div class="panel-body">
<form method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="name">Supplier Name</label>
<input type="text" class="form-control" name="name" />
</div>

<div class="form-group">
<label for="phone">Phone</label>
<input type="number" class="form-control" name="phone" />
</div>

<div class="form-group">
<label for="address">Address</label>
<input type="text" class="form-control" name="address" />
</div>

<div class="form-group input-group">
<label for="username">Products</label><br>
<input type="text" class="form-control" name="products" id="tags-input-products" placeholder="Type Products Here.." data-role="tagsinput" />
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
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$products=$_POST['products'];
	$date=date("d-m-Y");
	
	/* echo $name, $phone, $address, $products;
	die(); */

		$sql=mysqli_query($conn, "INSERT INTO suppliers(supplier_name, supplier_address, supplier_phone, products, date_added, status) VALUES('$name', '$address', '$phone', '$products', '$date', '1')");
	
		if(!$sql)
		{
			mysqli_error($conn);
			
			// echo "<script> AddError(); </script>";
		}
	
		else
		{
			echo "<script> alert('Record Added Successfully!'); </script>";
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
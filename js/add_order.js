$(document).ready(function() {
	
    $("#add_pro_full").click(function(){
		var productid = $(this).attr('selectid');
		var quantity=$("#qty").val();
		// return;
		$.post('./add_cart.php',{
			id:productid,
			qty:quantity,
			pay_type: 'full'
			},function(data){

				$('#cart_show').html(data);

				});
		return false;
		});
		
	$("#add_pro_inst").click(function(){
	var productid = $(this).attr('selectid');
	var quantity=$("#qty").val();
	// return;
		$.post('./add_cart.php',{
			id:productid,
			qty:quantity,
			pay_type: 'instalment'
			},function(data){
				
				$('#cart_show').html(data);
				
				});
		return false;
		});
		
});

//#ccc replaced by #add_pro_full/#add_pro_inst
//#xxx replaced by #cart_show
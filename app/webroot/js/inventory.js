	/*******   Order Section  ***************/
	
	 var counter =$('#countValues').val();
	 $('#test').on('click',function(e){
			if(counter>10){
					alert("Only 10 textboxes allow");
					return false;
			}else{
			var newTextBoxDiv = $(document.createElement('div'))
				 .attr("id", 'TextBoxDiv' + counter);
						
			newTextBoxDiv.after().html('<div class="form-group varHead"><label>Varient</label><label>SKU</label><label>BarCode</label><label>Price</label></div><div class="form-group varHead"><input type="text" id="varient' + counter + '" value="" class="form-control varientVal"  ><input type="text" id="sku' + counter + '" value="" class="form-control skuVal" ><input type="text" id="barcode' + counter + '" value="" class="form-control barcodeVal" ><input type="text" id="price' + counter + '" value="" class="form-control priceVal" style="margin-right:1%" > <a  onClick="boxRemove('+counter+')" rel="' + counter + '">remove</a></div>');
					
			newTextBoxDiv.appendTo("#TextBoxesGroup");
			counter++;
		  }
	 });
	 
	  $("#getVarientValue").click(function () {
		  if($('.varientVal').val()=='' || $('.skuVal').val()=='' || $('.barcodeVal').val()=='' || $('.priceVal').val()==''){
			  $('.error_msg_var').focus();
			  $('.error_msg_var').html('Please fill in the variant details');
			  return false;
			  //alert($(this).html());
		  }else{
			 var arr = [];
				var varient,price,sku,barcode,Varoptions,newDiv;
				for(i=0; i<counter; i++){
					varient = $('#varient' + i).val();
					price = $('#price' + i).val();
					sku=  $('#sku' + i).val();
					barcode = $('#barcode' + i).val();
					newDiv = $(document.createElement('div')).attr("id", 'ProductVarientPrice' + i);
					newDiv.after().html('<input type="hidden" name="data[Vary][val]['+i+'][price]" value="'+price+'"><input type="hidden" name="data[Vary][val]['+i+'][sku]" value="'+sku+'"><input type="hidden" name="data[Vary][val]['+i+'][barcode]" value="'+barcode+'"><input type="hidden" name="data[Vary][val]['+i+'][variant]" value="'+varient+'">');
					newDiv.appendTo("#varient-wrapper");
				}
	  		}
				//alert($('#varient-wrapper').html());
				//return false;
		});
		function boxRemove(id){
			 $("#TextBoxDiv" + id).remove();
		 }
	 
	 /****************   Invoice Section ****************/
	
	 $( "#invoiceAdd" ).submit(function( event ) {
		  var total_price=0;var total_quantity=0;
		  if($('.invoiceQuantitychk').val() != '' && $('.poVal').val() != '' ){
			  $('.invquan').each(function() {
				total_price += $(this).val() * parseFloat($(this).parent().next().find("input[type='text']").val());
				total_quantity += parseInt($(this).val());
				});
				$('#total_price').val(total_price);
				$('#total_quantity').val(total_quantity);
				//console.log(total_price);console.log(total_quantity);return false;
				$('#invoiceAdd').submit();
		  }
		  else{
		  $('.error_msg_var').html('Quantity field cannot be empty');
		  return false;
		  }
	});	
	
	$('#invoiceAddColoumn').on('click',function(e){
		if(counter>10){
				alert("Only 10 textboxes allow");
				return false;
		}else{
		var newTextBoxDiv = $(document.createElement('div'))
			 .attr("id", 'TextBoxDiv' + counter);
					
		newTextBoxDiv.after().html('<div class="col-md-12"> <div class="form-group varHead"><label>Coloumn Name</label><label>Value</label></div><div class="form-group varHead"><input type="text" id="coloumn' + counter + '" value="" name="col['+ counter +'][coloumn]" class="form-control varientVal"  ><input type="text" id="value' + counter + '" value="" name="col['+ counter +'][value]" class="form-control priceVal" style="margin-right:1%" > <a  onClick="boxRemove('+counter+')" rel="' + counter + '">remove</a></div>');
				
		newTextBoxDiv.appendTo("#TextBoxesGroup");
		counter++;
	  }
	});
	$('.datepicker').datepicker({
		format: 'yyyy/mm/dd',
		startDate: '-3d'
	});
	 
	 $( "#InvoiceChk" ).on('change',function(e){
			$.ajax({
			  type: 'POST',
			  url: '/invoices/invoiceChk',  //whatever any url
			  data: {label: $(this).val()},
			  success: function(message) {
				  if(message){
					  $('#InvoiceChk').attr('rel',1);
					  $('#error_msg').html('Invoice Number Exist Already');
					  $('#submitButton1').prop('disabled', true);
				  }else{
					  $('#InvoiceChk').attr('rel',0);
					  $('#error_msg').html('');
					  $('#submitButton1').prop('disabled', false);
				  }
			   }
		   });
    });
	 
	 
	 //  SHipping Section
	 
var VendorListURL =  $('#vendorListURL').val();
var ajaxURL =  $('#ajaxURL').val();
$('#VendorType').on('change',function(e){
		$('#VendorCatType').html('');$('#error_msg_no').html('');
		$.ajax({
			  type: 'POST',
			  url: VendorListURL,//whatever any url
			  data: {label: $(this).val()},
			  success: function(message) {
				  if(message != 'no'){
					  console.log(message);
					  $('#VendorCatType').html(message);
					  //For product section alone to stop next ajax on change VendorCatType
					  $('#VendorCatTypes').html(message);
				  }else{
					   $('.invoiceFormAll').hide();
		 			   $('#invoiceForm').html('');
					   $('#error_msg_no').html('Currently the vendor has no Invoice.');
					 	console.log(message);
				  }
			   }
		   });
});
$('#VendorCatType').on('change',function(e){
	$('#preloadForm').show();
	 if($(this).val()){
	 $('.invoiceFormAll').show();
	 $('#invoiceForm').html('');$('#error_msg_no').html('');
		$.ajax({
		  type: 'POST',
		  url: ajaxURL,//whatever any url
		  data: {label: $(this).val()},
		  success: function(message) {
			  $('#preloadForm').hide();
			  $('#invoiceForm').append(message);
		   }
	   });
	    }else{
		 $('#error_msg_no').html('');$('.invoiceFormAll').hide();$('#invoiceForm').html('');
		}
 });
	 
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
<?php echo $this->element('tableScript'); ?>
<div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">PO Update</h4>
        </div>
     </div>
     <?php echo $this->Form->create('Product',array('id'=>'orderAdd','type' => 'file','role'=>'form')); ?>
 	<div class="row">	
 	 <div class="col-md-8">
         <!--    Hover Rows  -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Products List
                <?php //echo '<pre>';print_r($products);?>
                <button class="btn btn-primary btn-lg" style="margin-left:57%;padding:7px 16px;" id="submitButton"> Click to update Order   </button>
            </div>
            <div class="panel-body">
                <div class="table-responsive" style="overflow-x:hidden;"><span class="error_msg_var"></span>
                
               <!--  <input id="filter" type="text" class="form-control" placeholder="Type here...">-->
                
                    <table id="order_tab" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->Paginator->sort('category'); ?></th>
                                <th><?php echo $this->Paginator->sort('title'); ?></th>
                                <th><?php echo $this->Paginator->sort('image'); ?></th>
                                <th><?php echo $this->Paginator->sort('brand'); ?></th>
                                <th><?php echo $this->Paginator->sort('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php $i=1; foreach ($products as $product): ?>
                            <tr id="NoncollapseExample<?php echo $i;?>">
                                <td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['category_name']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                                <td><?php echo $this->Html->image('product/small/'.$product['Product']['image']);?>&nbsp;</td>
                                <td><?php echo h($product['Product']['brand']); ?>&nbsp;</td>
                                <td><?php echo $this->Form->button('Order',array('class'=>'btn btn-default order','data-toggle'=>"collapse",'aria-expanded'=>false,'aria-controls'=>'collapseExample','href'=>'#collapseExample'.$i,'key'=>$i,'rel'=> htmlspecialchars(json_encode(($product['Vary'])))));  ?>
                                &nbsp;
                                <div id="wrapper<?php echo $i;?>" rel="<?php echo empty($product['Order']) ? 0 : 1 ;?>">
                                <?php 
								if(isset($product['Vary'])){
								$j =0; foreach ($product['Vary'] as $vary) { ?>
                                <input type="hidden" name="Vary[<?php echo $i; ?>][quantity][<?php echo $j; ?>]" id="itemQuantity<?php echo $j; ?>" placeholder="Quantity" value="<?php echo $vary['quantity'];?>" /> <input type="hidden" name="Vary[<?php echo $i; ?>][price][<?php echo $j; ?>]" value="<?php echo $vary['price']; ?>"   id="itemPrice<?php echo $j; ?>" /><input type="hidden" name="Vary[<?php echo $i; ?>][variant][<?php echo $j; ?>]" value="<?php echo $vary['variant']; ?>"  id="itemVariant" /><input type="hidden" name="Vary[<?php echo $i; ?>][sku][<?php echo $j; ?>]" value="<?php echo $vary['sku']; ?>" id="itemSKU" /><input type="hidden" name="Vary[<?php echo $i; ?>][barcode][<?php echo $j; ?>]" value="<?php echo $vary['barcode']; ?>"   id="itemBarcode" /><input type="hidden" name="Vary[<?php echo $i; ?>][product_id]" id="projectID<?php echo $i; ?>" value="<?php echo $vary['product_id']; ?>"  /> <input type="hidden" name="Vary[<?php echo $i; ?>][e_id]" id="EID<?php echo $i; ?>" value="<?php echo $vary['e_id']; ?>"  /><?php $j++;} } ?>
                                </div>
                         		<input type="hidden" name="Vary[<?php echo $i;?>][total_quantity]" id="total_quantity<?php echo $i;?>" value="0"  />
                                <input type="hidden" name="Vary[<?php echo $i;?>][total_price]" id="total_price<?php echo $i;?>" value="0"  />
                                <input type="hidden" name="Vary[<?php echo $i;?>][store_data]" id="store_data<?php echo $i;?>" value="0"  />
                                
                                </td>
                            </tr>
                            
                                
                        <?php $i++;  endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End  Hover Rows  -->
      </div>
    </div>

</div>
</div>
<script>

$('#submitButton').click( function() {
	$('#orderAdd').submit();
});

function format ( d,key ) {
 var toReturn; 
			
     toReturn =  '<table class="table table-hover"><thead><tr><th>#</th><th>Varient</th><th>SKU</th><th>Price</th><th>Quantity</th></tr></thead><tbody id="orderSaveID'+key+'">';
		$(jQuery.parseJSON(d)).each(function(i) {
			var itemQuantityVal = '';   
			var $myDiv = $('#wrapper'+key).attr('rel');
			console.log($myDiv);
			if ($myDiv == true)
			itemQuantityVal = $('#wrapper'+key).find('#itemQuantity'+i).val();
			else{
			 $('#wrapper'+key).append('<input type="hidden" name="Vary['+key+'][quantity]['+i+']" id="itemQuantity'+i+'" placeholder="Quantity" /> <input type="hidden" name="Vary['+key+'][price]['+i+']" value='+this.price+'   id="itemPrice'+i+'" /><input type="hidden" name="Vary['+key+'][variant]['+i+']" value='+this.variant+'   id="itemVariant" /><input type="hidden" name="Vary['+key+'][sku]['+i+']" value='+this.sku+' id="itemSKU" /><input type="hidden" name="Vary['+key+'][barcode]['+i+']" value='+this.barcode+'   id="itemBarcode" /><input type="hidden" name="Vary['+key+'][product_id]" id="projectID'+key+'" value='+this.product_id+'  />');
			}
	 		toReturn += '<tr><td>'+this.id+'</td><td>'+this.variant+'</td><td>'+this.sku+'</td><td>'+this.price+'</td><td><input type="text" name="Vary['+key+'][quantity]['+i+']" id="itemQuantity" placeholder="Quantity" value="'+itemQuantityVal+'"/></td></tr>';
			
		});
		toReturn += ' <tr></tr></tbody></table>';
		return toReturn;
}


    $(document).ready(function() {
		var arr=[];
		var table = $('#order_tab').DataTable();
			$('.order').on('click', function () {
				var tr = $(this).closest('tr');
				var row = table.row( tr );
		 		var d= $(this).attr('rel');
				var key= $(this).attr('key');
				var total_price=0;
				var total_quantity=0;
				
				if ( row.child.isShown() ) {
				
				// Save the quantity of each box on purchase Order
				$('#orderSaveID'+key).find("input[type='text']").each(function(i) {
					total_price += $(this).val() * parseFloat($('#wrapper'+key).find("#itemPrice"+i).val());
					total_quantity += isNaN(parseInt($(this).val())) ? 0 :  parseInt($(this).val());
					$('#wrapper'+key).find('#itemQuantity'+i).val($(this).val());
				});
				
				// if no quantity mentioned below shows the error
				if(total_quantity==0){
					 $('.error_msg_var').html('Quantity field cannot be empty');
					 return false;
				}
				else
			 	$('.error_msg_var').html('');
				
				// calculate te total price and quantity for each product for order
				$('#total_price'+key).val(total_price);
				$('#total_quantity'+key).val(total_quantity);
				$('#store_data'+key).val(true);
				
				// Updated the attribute to retain the text box value, we saved earlier
				$('#wrapper'+key).attr('rel',1);
				
				// Add green background to convey the success of order.
				$('#NoncollapseExample'+key).addClass('success');
				
				// Hide the child row once it in open status.
				row.child.hide();
				tr.removeClass('shown');
				}
				else {
					// Show the child row once it in close status. send the child row content to format function above
					row.child( format ( d,key ) ).show();
					tr.addClass('shown');
				}
		
			});
	});
</script>
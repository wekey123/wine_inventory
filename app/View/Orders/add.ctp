<div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Orders</h4>
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
                <button class="btn btn-primary btn-lg" style="margin-left:57%;padding:7px 16px;" id="submitButton"> Click to Make an Order   </button>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                
                 <input id="filter" type="text" class="form-control" placeholder="Type here...">
                
                    <table class="table table-hover">
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
                        <tbody class="searchable">
                         <?php $i=1; foreach ($products as $product): ?>
                            <tr id="NoncollapseExample<?php echo $i;?>">
                                <td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['category_name']); ?>&nbsp;</td>
                                <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                                <td><?php echo $this->Html->image('product/small/'.$product['Product']['image']);?>&nbsp;</td>
                                <td><?php echo h($product['Product']['brand']); ?>&nbsp;</td>
                                <td><?php echo $this->Form->button('Order',array('class'=>'btn btn-default order','data-toggle'=>"collapse",'aria-expanded'=>false,'aria-controls'=>'collapseExample','href'=>'#collapseExample'.$i));  ?>
                                &nbsp;</td>
                                	
                            </tr>
                            <tr class="collapse" id="collapseExample<?php echo $i;?>">
                            <td colspan="6">
                             <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Varient</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                        		<tbody id="orderSaveID<?php echo $i;?>">
                                 <?php $j=1; foreach ($product['Vary'] as $productVary):
								 if($productVary['type']=='product'){ ?>
                            		<tr>
                                        <td><?php echo h($j); ?>&nbsp;</td>
                                        <td><?php echo h($productVary['variant']); ?>&nbsp;</td>
                                        <td><?php echo h($productVary['sku']); ?>&nbsp;</td>
                                        <td><?php echo h($productVary['price']); ?>&nbsp;</td>
                                        <td><input type="text" name="Vary[<?php echo $i;?>][quantity][<?php echo $j; ?>]" id="itemQuantity" placeholder="Quantity"  />&nbsp;
                                        <input type="hidden" name="Vary[<?php echo $i;?>][price][<?php echo $j; ?>]" value="<?php echo h($productVary['price']); ?>"   id="itemPrice" />
                                        <input type="hidden" name="Vary[<?php echo $i;?>][variant][<?php echo $j; ?>]" value="<?php echo h($productVary['variant']); ?>"   id="itemVariant" />
                                        <input type="hidden" name="Vary[<?php echo $i;?>][sku][<?php echo $j; ?>]" value="<?php echo h($productVary['sku']); ?>"   id="itemSKU" />
                                        <input type="hidden" name="Vary[<?php echo $i;?>][barcode][<?php echo $j; ?>]" value="<?php echo h($productVary['barcode']); ?>"   id="itemBarcode" />
                                      
                                        </td>
                            		</tr>
                                 <?php $j++;} ?>
                                   
                                  <?php  endforeach; ?>
                                 <tr><td colspan="6" align="right">
                                 <?php echo $this->Form->button('Save',array('class'=>'btn btn-default saveOrder','data-toggle'=>"collapse",'aria-expanded'=>false,'aria-controls'=>'collapseExample','href'=>'#collapseExample'.$i,'id'=>$i));  ?>
                                 </td></tr>
                            	</tbody>
                            </table></td></tr>
                            <input type="hidden" name="Vary[<?php echo $i;?>][product_id]" id="projectID<?php echo $i;?>" value="<?php echo h($productVary['product_id']); ?>"  />
                                        <input type="hidden" name="Vary[<?php echo $i;?>][total_quantity]" id="total_quantity<?php echo $i;?>" value="0"  />
                                        <input type="hidden" name="Vary[<?php echo $i;?>][total_price]" id="total_price<?php echo $i;?>" value="0"  />
                                        <input type="hidden" name="Vary[<?php echo $i;?>][store_data]" id="store_data<?php echo $i;?>" value="0"  />
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
var orderData = []; 
var projectID;
$('.saveOrder').click(function(){
	var fields = {};var total_price=0;var total_quantity=0;
	$('#orderSaveID'+$(this).attr('id')).find("input[type='text']").each(function() {
		fields[this.name] = $(this).val();
		total_price += $(this).val() * parseFloat($(this).parent().find("#itemPrice").val());
		total_quantity += parseFloat($(this).val());
	});
	$('#total_price'+$(this).attr('id')).val(total_price);
	$('#total_quantity'+$(this).attr('id')).val(total_quantity);
	$('#store_data'+$(this).attr('id')).val(true);
	projectID = $('#projectID'+$(this).attr('id')).val();
	var obj = {fields: fields, projectID: projectID}; 
	orderData.push(obj);
	$('#NoncollapseExample'+$(this).attr('id')).addClass('success');
 });
$('#submitButton').click( function() {
	$('#orderAdd').submit();
});
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});

</script>

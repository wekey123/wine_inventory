				<script>
						  $(function() {
							$('.datepicker').datepicker({
								format: 'mm/dd/yyyy',
								startDate: '-3d'
							});
						  });
				  </script>
                      <div class="col-md-12">
                        <h1 class="page-head-line" style="font-size:16px;"><?php echo __('Invoice Details'); ?> <span id="error_msg"></span></h1> 
                    </div>
                      
						<div class="row">
            				<div class="col-md-12">
        		               <div class="col-md-6">
                                 <div class="alert alert-warning">
                               <?php 
								   echo $this->Form->input('Shipping.po_no',array('div'=>false,'error'=>false,'type'=>'hidden', 'value' => $invoice['Invoice']['po_no']));
							   ?>
                               
                              <strong><?php echo __('Vendor Name'); ?></strong> <span> : </span> <span><?php $vendor=$this->Util->getVendorName($invoice['Invoice']['vendor_id']); echo h($vendor['Vendor']['name']); ?></span> <br />
                                <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['invoice_no']); ?></span> <br />
                               <strong><?php echo __('Invoice Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateOnlyFormat($invoice['Invoice']['invoice_date']); ?></span> <br /> 
                               <strong><?php echo __('Total Quantity'); ?></strong> <span> : </span> <span id="invoiceqty"><?php echo h($invoice['Invoice']['total_quantity']); ?></span> <br />
                               
                                
                               </div>
                               </div>
                               <div class="col-md-6">
                                 <div class="alert alert-warning">
                                <strong><?php echo __('Total Amount'); ?></strong> <span> : </span> <span><?php echo $this->Util->currencyFormat($invoice['Invoice']['total_price']); ?></span> <br />
                                <?php $due= $this->Util->getAmountDue();?>
                                <strong><?php echo __('Amount Due'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($due);  ?></span> <br />
                               
                               <strong><?php echo __('Shipment By'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['shipping_method']); ?></span> <br />
                              <strong><?php echo __('Created Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateFormat($invoice['Invoice']['created']); ?></span> <br />
                                
                                </div>
                            	</div>
                             </div>
        				</div>
                         <div class="col-md-12">
                        <h1 class="page-head-line" style="font-size:16px;"><?php echo __('Invoice Form'); ?> <span id="error_msg"></span></h1> 
                    </div>
                        <div class="row invoiceFormAll">
        				   <div class="col-md-5" style="margin-right:10%;">   
								<?php
                                
                                    echo $this->Form->input('Shipping.total_ship_qty',array('div'=>false,'error'=>false,'type'=>'hidden'));
                                    echo $this->Form->input('Shipping.total_unship_qty',array('div'=>false,'error'=>false,'type'=>'hidden'));
                                    echo $this->Form->input('Shipping.total_inb_qty',array('div'=>false,'error'=>false,'type'=>'hidden'));
                                    echo $this->Form->input('Shipping.total_inb_ship_missing_qty',array('div'=>false,'error'=>false,'type'=>'hidden'));
                                    echo $this->Form->input('Shipping.total_defect_qty',array('div'=>false,'error'=>false,'type'=>'hidden'));
                                    echo $this->Form->input('Shipping.total_sellable_qty',array('div'=>false,'error'=>false,'type'=>'hidden'));
									 echo $this->Form->input('Shipping.total_invoice_qty',array('div'=>false,'error'=>false,'type'=>'hidden'));
                                    
                                    echo $this->Form->input('Shipping.shipping_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Shipment Number</label>','label'=>false));
                                    
                                    echo $this->Form->input('Shipping.received_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Shipment Received Date</label>','label'=>false));
                                ?>
	
	</div>
						   <div class="col-md-5">   
	<?php 	
		echo $this->Form->input('Shipping.shipping_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Shipment Method</label>','label'=>false));
		echo $this->Form->input('Shipping.tracking_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span>  Shipment Tracking No</label>','label'=>false));
		
	?>
    </div>
					    </div>
                        
                        <div class="row">	
                             <div class="col-md-12">
                                             <!--    Hover Rows  -->
                                <div class="panel panel-default">
                                                <div class="panel-heading">
                                                   <label style="color:#a94442;">PO Products List </label>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive" style="overflow-x:hidden;"><span class="error_msg_var"></span>
                                                        <table id="invoice_tab1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th><?php echo $this->Paginator->sort('Product Name'); ?></th>
                                                                   
                                                                    <th><?php echo $this->Paginator->sort('PO QTY'); ?></th>
                                                                    <th><?php echo $this->Paginator->sort('Invoice Quantity'); ?></th>
                                                                    <th><?php echo $this->Paginator->sort('Shipment Qty'); ?></th>
                                                                    <th><?php echo $this->Paginator->sort('INB_Qty'); ?></th>
                                                                    <th><?php echo $this->Paginator->sort('Defect Qty'); ?></th>
                                                                    <th><?php //echo $this->Paginator->sort('Order Number'); ?><input type="checkbox" name="" class="all"  /></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="invoiceSaveID">
                                                             <?php //echo '<pre>';print_r($invoice['Vary']);
															 
															 $i =1;$j =1;
															 foreach ($invoice['Vary'] as $product):
                                                             if(($product['type'] =='invoice')){?>
                                                                <tr>
                                                                    <td><?php echo $i; ?>&nbsp;</td>
                                                                    <td><?php $prod=$this->Util->getProductDetails($product['product_id']); echo $prod['Product']['title'] ?>&nbsp;</td>
                                                                    <td><?php $ordDetails=$this->Util->getOrderQuantityByVarid($product['var_id']); echo $ordDetails['Vary']['quantity']; ?>
                                                                    </td>
                                                                    <td><?php echo h($product['quantity']); ?>&nbsp;</td>
                                                                    <td>
                                                                    <input type="text" value="<?php echo $product['ship_qty'] > 0 ? $product['ship_qty'] : '';?>" name="Vary[<?php echo $i; ?>][ship_qty]" class="shippingQuantitychk"  />
                                                                   
                                                                    </td>
                                                                    <td>
                                                                     <input type="text" value="<?php echo $product['inb_qty'] > 0 ? $product['inb_qty'] : '';?>" name="Vary[<?php echo $i; ?>][inb_qty]" class="inbQuantitychk"  />
                                                                     
                                                                     </td>
                                                                     <td>
                                                                      <input type="text" value="<?php echo $product['defect_qty'] > 0 ? $product['defect_qty'] : '';?>" name="Vary[<?php echo $i; ?>][defect_qty]" class="defectQuantitychk"  />
                                                                      
                                                                     </td>
                                                                     <td><input type="checkbox" <?php echo $product['ship_qty'] > 0 ? ($product['ship_qty'] == $product['inb_qty'] ? 'checked="checked"' : '') : '';?> rel="<?php echo $product['quantity'];?>" name="" id="<?php echo $i ?>" class="varchk"  />&nbsp;
                                                         
                                                         
                                                          
                                                                    </td>
                                                                </tr>
                                                            <?php $i++; ?> <input type="hidden" class="Allchk" value="<?php echo isset($product['inv_count']) ? ($product['inv_count'] == $product['quantity'] ? $j++ : $j--) : $j--;?>" rel="<?php echo $j == $i ? true : false; ?>" rel2="<?php echo $j; ?>"  rel3="<?php echo $i; ?>"/><?php } endforeach; ?>
                                                          
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End  Hover Rows  -->
                              </div>
                        </div>
                                
                                <div  class="row invoiceFormAll">
     <div class="col-md-6">                            
     <?php echo $this->Form->submit(__('Save Shipment'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1','name'=>'submit')); ?>
     </div>
     <div class="col-md-6"> 
     <?php
	 echo $this->Form->submit(__('Save for Sale'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton2','name'=>'submit'));
	  echo $this->Form->end();	?>
      </div>
     </div>
    <script>                            
    $('document').ready(function(){
		$(".all").on("change",function () {//alert('');
			if($(this).is(":checked")){
				$(".varchk").prop("checked", true);
					$('input[type=checkbox]').each(function () {
						$(this).parent().parent().find('.shippingQuantitychk').val($(this).attr('rel'));
						$(this).parent().parent().find('.inbQuantitychk').val($(this).attr('rel'));
						$(this).parent().parent().find('.defectQuantitychk').val(0);
					});
			}else{console.log('b');
				$(".varchk").prop("checked", false);
				$('input[type=checkbox]').each(function () {
						$(this).parent().parent().find('.shippingQuantitychk').val('');
						$(this).parent().parent().find('.inbQuantitychk').val('');
						$(this).parent().parent().find('.defectQuantitychk').val('');
				});
			}
		});
		
		$(".varchk").on("change",function () {
		//alert("You have checked  "+$(".td:checked").length+"  boxes");
		if($(".varchk").length == $(".varchk:checked").length) {
			$(".all").prop("checked", true);
		} else {
			$(".all").prop("checked", false);
		}
		if($(this).is(":checked")){
		$(this).parent().parent().find('.shippingQuantitychk').val($(this).attr('rel'));
		$(this).parent().parent().find('.inbQuantitychk').val($(this).attr('rel'));
		$(this).parent().parent().find('.defectQuantitychk').val(0);
		}else{
		$(this).parent().parent().find('.shippingQuantitychk').val('');
		$(this).parent().parent().find('.inbQuantitychk').val('');
		$(this).parent().parent().find('.defectQuantitychk').val('');		
		}});
		
		$("#submitButton2").on("click",function () {
			var r = confirm("Are you sure want to move the products for Sale. Please note that you cannot edit the shipment details once you have moved the products for sale?");
			if (r == true)
			$('#ShippingForm').submit();
			else
			return false;
		});
		
		
});
		    </script>               
                    
                    
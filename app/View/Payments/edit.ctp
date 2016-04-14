<?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>
<script>
$(function() {
	$('.datepicker').datepicker({
	format: 'yyyy-mm-dd',
	startDate: '-3d'
   });
});
</script>
<div class="content-wrapper">
    <div class="container">
<?php echo $this->Form->create('Payment'); ?>
	<div class="row">
            <div class="col-md-12">
             	<?php echo $this->Html->link('View Payment', array('action' => 'view', $invoice['Invoice']['invoice_no']),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
                
                <h1 class="page-head-line"><?php echo __('Edit Payment Details'); ?> </h1>
                
            </div>
        </div>
        
        <?php  
				   		  $totalAmountPayed = array();
						  $paymentqty = array();
				          $this->Util->setInvoiceTotalPrice($invoice['Invoice']['total_price']);
						  $this->Util->setInvoiceTotalQty($invoice['Invoice']['total_quantity']);
				   		  foreach ($invoice['Payment'] as $Payment):
					      $totalAmountPayed[] = $Payment['payment_amount'];
						  $paymentqty[] = $Payment['payment_qty'];
					      endforeach; 
					      $TotalAmountPayed = array_sum($totalAmountPayed);
					      $this->Util->setTotalAmountPayed($TotalAmountPayed);
						  
						  $paymentqty = array_sum($paymentqty);
						  $this->Util->setPayedQty($paymentqty);	  
					?>
          		  <div class="row">
                        <div class="col-md-12">
                         <div class="col-md-6">
                            <div class="alert alert-warning">
                               <strong><?php echo __('PO Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['po_no']); ?></span> <br />
                               <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['invoice_no']); ?></span> <br />
                               <strong><?php echo __('Total Quantity'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['total_quantity']); ?></span> <br />
                               <strong><?php echo __('Quantity Left'); ?></strong> <span> : </span> <span><?php echo $this->Util->getQtyLeft(); ?></span> <br />
                               
                               <strong><?php echo __('Total Amount'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($invoice['Invoice']['total_price']);  ?></span> <br />
                               <strong><?php echo __('Amount Due'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($this->Util->getAmountDue());  ?></span> <br />
                               <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php echo h($invoice['User']['username']); ?></span> <br />
                            
                            </div>
                          </div>
                          
                          <div class="col-md-6">  
                            <div class="alert alert-warning">
                                  <strong><?php echo __('Created On'); ?></strong> <span> : </span> <span><?php
							   echo $this->Util->dateFormat(strtotime($invoice['Invoice']['created'])); 
							   //echo h($invoice['Invoice']['created']); ?></span> <br />
                               <strong><?php echo __('Vendor Name'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['vendor_name']); ?></span> <br />
                               <strong><?php echo __('Vendor Address'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['vendor_address']); ?></span> <br />
                           <strong><?php echo __('Shipping Method'); ?></strong> <span> : </span> <span><?php  echo $invoice['Invoice']['shipping_method'];  ?></span> <br />
                               <strong><?php echo __('Payment Terms'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['payment_terms']); ?></span> <br />
                                <strong><?php echo __('Invoice Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->dateOnlyFormat($invoice['Invoice']['invoice_date']); ?></span> <br />
                               <strong><?php echo __('Estimated Shipping Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->dateOnlyFormat($invoice['Invoice']['estimated_shipping_date']); ?></span> <br />
                            </div>
                          </div>
                          
                        </div>
            		</div>
        
         <div class="row">	
                     <div class="col-md-12" style="color:#000000; text-align:center; font-size:20px;">
                       			 <h1 class="page-head-line"><?php echo __('Payment History'); ?> </h1>
                    </div>
          </div>
  	<?php
		$i =1; $j = 0;
	  	foreach($invoice['Payment'] as $payment){
	 ?>              
    <div class="row">
   		 <div class="panel-heading">
                           <h5 style="font-weight:bold;color:#a94442"> Payment Release # <?php echo $i; ?></h5>
          </div>
        <div class="col-md-5" style="margin-right:10%;">         

	<?php	
		echo  $this->Form->input('Payment.'."$j".'.id');
		echo $this->Form->input('Payment.'."$j".'.invoice_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','id'=>'tags', 'disabled' => 'disabled','between'=>'<label><span class="mandatory">*</span> Invoice Number</label>','label'=>false));
		echo $this->Form->input('Payment.'."$j".'.payment_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Payment Number</label>','label'=>false));
		echo $this->Form->input('Payment.'."$j".'.payment_qty',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control Paymentqty','between'=>'<label><span class="mandatory">*</span> Payment Quantity</label>','label'=>false));
		
		
	?>
	</div>
    <div class="col-md-5"> 
   		<?php 
		echo $this->Form->input('Payment.'."$j".'.payment_amount',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control PaymentValue','between'=>'<label><span class="mandatory">*</span> Payment Amount</label>','label'=>false));
		echo $this->Form->input('Payment.'."$j".'.payment_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Payment Date</label>','label'=>false));
		echo $this->Form->input('Payment.'."$j".'.payment_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Payment Method</label>','label'=>false));
		
		?>
    </div>
	</div>
	<?php $i++; $j++; } $due= $this->Util->getAmountDue();?>
    <input type="hidden" name="dueAmount" value="<?php echo $due;?>"  /><input type="hidden" name="totalAmount" value="<?php echo $invoice['Invoice']['total_price'];?>"  /><input type="hidden" name="po_no" value="<?php echo $invoice['Invoice']['po_no'];?>"  />
 	<div class="row">
        <div class="col-md-12">
        	 <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1')); echo $this->Form->end();	?>
        </div>
    </div>


</div>
</div>  
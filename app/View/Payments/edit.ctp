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
                
                <h1 class="page-head-line"><?php echo __('Edit Payment'); ?> </h1>
            </div>
        </div>
         <div class="row">	
                     <div class="col-md-12" style="color:#000000; text-align:center; font-size:20px;">
                       			Payment History
                    </div>
          </div>
  	<?php
		$i =1; $j = 0;
	  	foreach($invoice['Payment'] as $payment){
	 ?>              
    <div class="row">
   		 <div class="panel-heading">
                           <h5 style="font-weight:bold"> Payment Release # <?php echo $i; ?></h5>
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
	<?php $i++; $j++; } ?>
 	<div class="row">
        <div class="col-md-12">
        	 <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1')); echo $this->Form->end();	?>
        </div>
    </div>


</div>
</div>  
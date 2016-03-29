<?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>
<script>
  $(function() {
    var availableTags = <?php echo json_encode($invoicelist); ?>;
    $( "#tags" ).autocomplete({
      source: availableTags,
	  select: function (event, ui) {
		 
	}
    });
	
	$('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	});
  });
 
  </script>
<div class="content-wrapper">
    <div class="container">
    <?php echo $this->Form->create('Shipping',array('id'=>'inventoryAdd','type' => 'file','role'=>'form')); ?>
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Shipping'); ?> </h1>
            </div>
        </div>
                
    <div class="row">
        <div class="col-md-5" style="margin-right:10%;">   
	<?php
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('po_no',array('div'=>false,'error'=>false,'type'=>'hidden'));
		//echo $this->Form->input('payment_no',array('div'=>false,'error'=>false,'type'=>'hidden'));
		
		echo $this->Form->input('invoice_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','id'=>'tags','between'=>'<label><span class="mandatory">*</span> Invoice Number</label>','label'=>false));
		echo $this->Form->input('shipping_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Shipping Number</label>','label'=>false));
		echo $this->Form->input('shipping_quantity',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Total Shipped Quantity</label>','label'=>false));
		//echo $this->Form->input('unshipped_quantity',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>','class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Total Shipped Quantity</label>','label'=>false));
		//echo $this->Form->input('Shipping.missing_quantity',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
	?>
    </div>
    <div class="col-md-5"> 
    <?php 	
		echo $this->Form->input('shipping_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('tracking_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('weight',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('received_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Shipping Received Date</label>','label'=>false));
	?>
	</div>
</div>

    <div class="row">
            <div class="col-md-12">
                <div id="invoiceForm"></div>
            </div>
        </div>
     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1')); echo $this->Form->end();	?>
</div>
</div>
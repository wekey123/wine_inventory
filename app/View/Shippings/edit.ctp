<?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>

<div class="content-wrapper">
    <div class="container">
    <?php echo $this->Form->create('Shipping',array('id'=>'inventoryAdd','type' => 'file','role'=>'form')); ?>  
    <?php $i=1;foreach($this->request->data as $this->request->data) { ?>
    <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Edit Shipping ('.$this->request->data['Shipping']['shipping_no'].')'); ?> </h1>
            </div>
        </div>
                
    <div class="row">
        <div class="col-md-5" style="margin-right:10%;">   
	<?php
		$key='Shipping['.$i.']';
		echo $this->Form->input('id',array('div'=>false,'error'=>false,'type'=>'hidden','name'=>$key.'[id]'));
		//echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden','name'=>$key.'[user_id]'));
		echo $this->Form->input('po_no',array('div'=>false,'error'=>false,'type'=>'hidden','name'=>$key.'[po_no]'));
		echo $this->Form->input('invoice_quantity',array('div'=>false,'error'=>false,'type'=>'hidden','name'=>$key.'[invoice_quantity]'));
		//echo $this->Form->input('payment_no',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('invoice_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','id'=>'tags','between'=>'<label><span class="mandatory">*</span> Invoice Number</label>','label'=>false,
		'name'=>$key.'[invoice_no]'));
		echo $this->Form->input('shipping_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Shipping Number</label>','label'=>false,'name'=>$key.'[shipping_no]'));
		echo $this->Form->input('shipping_quantity',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Total Shipped Quantity</label>','label'=>false,'name'=>$key.'[shipping_quantity]'));
		//echo $this->Form->input('unshipped_quantity',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>','class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Total Shipped Quantity</label>','label'=>false,'name'=>$key.'[unshipped_quantity]'));
		
	?>
    </div>
    <div class="col-md-5"> 
    <?php 	
		echo $this->Form->input('shipping_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','name'=>$key.'[shipping_method]'));
		echo $this->Form->input('tracking_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','name'=>$key.'[tracking_no]'));
		echo $this->Form->input('weight',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','name'=>$key.'[weight]'));
		echo $this->Form->input('received_date',array('div'=>false,'error'=>false,'type'=>'text', 'id'=>'rdate'.$i, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker'.$i,'between'=>'<label><span class="mandatory">*</span> Shipping Received Date</label>','label'=>false,'name'=>$key.'[received_date]'));
	?>
	</div>
</div>
<script>
  $(function() {
   	$('#rdate<?php echo $i;?>').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	});
  });
</script>
  <?php $i++;} ?>
     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1')); echo $this->Form->end();	?>
</div>
</div>
   <?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>
  <script>
  $(function() {
    var availableTags = <?php echo json_encode($orderlist); ?>;
    $( "#tags" ).autocomplete({
      source: availableTags,
	  select: function (event, ui) {
		  $('#invoiceForm').html('');
			$.ajax({
			  type: 'POST',
			  url: '/invoices/ajax',  //whatever any url
			  data: {label: ui.item.label},
			  success: function(message) {
				  $('#invoiceForm').append(message);
			   }
		   });

	}
    });
  });
 
  </script>
<style>
.varHead label{
	width:25%;
	margin-bottom:0px;
}
.varHead input[type="text"]{
	width:15%;
	float:left;
	margin-right:10%;
	margin-bottom:0px;
}
</style>
<div class="content-wrapper">
    <div class="container">
    <?php echo $this->Form->create('Invoice',array('id'=>'invoiceAdd','role'=>'form')); ?>
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Invoice'); ?> </h1>
            </div>
        </div>
                
    <div class="row">
        <div class="col-md-5" style="margin-right:10%;">               

	<?php
		echo $this->Form->input('po_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control poVal','id'=>'tags','between'=>'<label><span class="mandatory">*</span> Order Number</label>','label'=>false));
		echo $this->Form->input('invoice_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Invoice Number</label>','label'=>false));
		echo $this->Form->input('invoice_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Invoice Date</label>','label'=>false));
		echo $this->Form->input('vendor_name',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('vendor_address',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('total_price',array('div'=>false,'error'=>false,'type'=>'hidden','id'=>'total_price'));
		echo $this->Form->input('total_quantity',array('div'=>false,'error'=>false,'type'=>'hidden','id'=>'total_quantity'));
		
	?>
	</div>
    <div class="col-md-5"> 
   		<?php 
			echo $this->Form->input('customer_id',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label> Customer Number</label>','label'=>false));
		echo $this->Form->input('shipping_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Shipping Method</label>','label'=>false));
		echo $this->Form->input('estimated_shipping_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Estimated Shipping Date</label>','label'=>false));
		echo $this->Form->input('payment_terms',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		
		?>
    </div>
</div>

<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<div class="panel-heading">Invoice Coloumns <span class="error_msg_var"></span> <a id="invoiceAddColoumn" class="btn btn-primary addmore">Add More Coloumns</a><!--<span class="varient-enable glyphicon glyphicon-plus"></span>--></div>              
                <div class="panel-body" id="varient_body">           
                
                 <div id='TextBoxesGroup'>	</div>
                </div>
            </div>
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
  <input type="hidden" name="" id="countValues" value="1" />
<?php echo $this->Html->script('inventory'); ?>



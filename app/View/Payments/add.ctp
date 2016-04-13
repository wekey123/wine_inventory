   <?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); 
    $ServerBaseURL = Configure::read('ServerBaseURL');
	?>
  <script>
  $(function() {
   
	$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
   });
});

  </script>

<div class="content-wrapper" style="min-height:0px; overflow:visible">
    <div class="container">
    <?php echo $this->Form->create('Payment',array('id'=>'paymentAdd','type' => 'file','role'=>'form')); ?>
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Payment Entry'); ?></h1> 
            </div>
            <div class="col-md-12"><span id="error_msg_no" style="color:red"></span></div>
        </div>
        
     <div class="row">
     	<div class="col-md-5" style="margin-right:10%;"> 
		   <?php echo $this->Form->input('vendor_id',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$vendor, 'id'=>'VendorType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the Vendor",'between'=>'<label><span class="mandatory">*</span> Vendor Name</label>','label'=>false));?>
        </div>
     	<div class="col-md-5"> 
		   <?php echo $this->Form->input('invoice_no',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>'', 'id'=>'VendorCatType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the VendorType",'between'=>'<label><span class="mandatory">*</span> Invoice Lists</label>','label'=>false));?>
        </div>
     </div> 
     
    <div class="row invoiceFormAll" style="display:none">
    	<div class="col-md-12">
           <h1 class="page-head-line"><?php echo __('Payment Entry'); ?></h1> 
        </div>
        <div class="col-md-12">
           <span class="error_msg_var" style="margin:0px; font-size:14px;font-style:normal"></span>
        </div>
        <div class="col-md-5" style="margin-right:5%;">    
        
	<?php
		//echo $this->Form->input('vendor_id',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$vendor, 'id'=>'VendorType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the Vendor",'between'=>'<label><span class="mandatory">*</span> Vendor Name</label>','label'=>false));
		//echo $this->Form->input('vendor_type',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>'', 'id'=>'VendorCatType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the Invoice",'between'=>'<label><span class="mandatory">*</span> Vendor Type</label>','label'=>false));
	
		//echo $this->Form->input('invoice_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','id'=>'tags','between'=>'<label><span class="mandatory">*</span> Invoice Number</label>','label'=>false));
		echo $this->Form->input('payment_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Payment Number</label>','label'=>false));
		echo $this->Form->input('payment_qty',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control Paymentqty','between'=>'<label><span class="mandatory">*</span> Payment Quantity</label>','label'=>false));
		echo $this->Form->input('payment_amount',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control PaymentValue','between'=>'<label><span class="mandatory">*</span> Payment Amount</label>','label'=>false));
		echo $this->Form->input('payment_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Payment Date</label>','label'=>false));
		echo $this->Form->input('payment_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Payment Method</label>','label'=>false));
	?>
    </div>
    <div class="col-md-6">
    	<div id="invoiceForm" style="margin-top:30px;"></div>
	</div>
</div>
<div class="row invoiceFormAll" style="display:none">
     <div class="col-md-12">
     	<?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1')); echo $this->Form->end();	?>
     </div>
</div>

</div>
</div>
<script>
 $( ".PaymentValue" ).change(function() {
	 console.log($(this).val());
	 console.log($('#myDueamt').val());
  if(parseFloat($(this).val()) > parseFloat($('#myDueamt').val()) && parseFloat($(this).val()) > 0.99){
	  console.log('s');
	  $('.error_msg_var').html('Please enter the amount less than due amount.');
	  $('.btn-block').prop('disabled', true);
  }
  else{console.log('n');
  	  $('.error_msg_var').html('');
  	  $('.btn-block').prop('disabled', false);
  }
});


$( "#PaymentPaymentQty" ).change(function() {	
	var invoiceqty = $("#totalqtyhistory").val();
	console.log(invoiceqty);
	var paymentqty = $(this).val();
	console.log(paymentqty);
	if (typeof invoiceqty !== 'undefined') {
		var invoiceqty = parseInt(invoiceqty);
		if(paymentqty <= invoiceqty && paymentqty >0){
			 $('.error_msg_var').html('');
			 $('.btn-block').prop('disabled', false);
		}else{
			  $('.error_msg_var').html('Please enter the quantity less than or equal to Invoice quantity left.');
			  $('.btn-block').prop('disabled', true);
		}
	}else{
		$('.error_msg_var').html('Enter Your Invoice No first');
		$('.btn-block').prop('disabled', true);
	}
});

$('#VendorType').on('change',function(e){
		$('#VendorCatType').html('');
		$.ajax({
			  type: 'POST',
			  url: '<?php echo $ServerBaseURL.'/payments/invoicelist'; ?>',//whatever any url
			  data: {label: $(this).val()},
			  success: function(message) {
				  if(message != 'no'){
					  console.log(message);
					  $('#VendorCatType').html(message);
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
	 if($(this).val()){
		 $('.invoiceFormAll').show();
	 $('#invoiceForm').html('');$('#error_msg_no').html('');
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $ServerBaseURL.'/payments/ajax'; ?>',//whatever any url
		  data: {label: $(this).val()},
		  success: function(message) {
			  $('#invoiceForm').append(message);
		   }
	   });
	    }else{
		 $('#error_msg_no').html('');$('.invoiceFormAll').hide();$('#invoiceForm').html('');
		}
 });
</script>
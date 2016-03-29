   <?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>
  <script>
  $(function() {
    var availableTags = <?php echo json_encode($invoicelist); ?>;
    $( "#tags" ).autocomplete({
      source: availableTags,
	  select: function (event, ui) {
		  $('#invoiceForm').html('');
			$.ajax({
			  type: 'POST',
			  url: '/payments/ajax',  //whatever any url
			  data: {label: ui.item.label},
			  success: function(message) {
				  $('#invoiceForm').append(message);
			   }
		   });

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
    <span class="error_msg_var" style="margin:0px;"></span>
    <?php echo $this->Form->create('Payment',array('id'=>'paymentAdd','type' => 'file','role'=>'form')); ?>
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Payment'); ?> </h1>
            </div>
        </div>
                
    <div class="row">
        <div class="col-md-5" style="margin-right:5%;">    
	<?php
		echo $this->Form->input('invoice_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','id'=>'tags','between'=>'<label><span class="mandatory">*</span> Invoice Number</label>','label'=>false));
		echo $this->Form->input('payment_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Payment Number</label>','label'=>false));
		echo $this->Form->input('payment_qty',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control Paymentqty','between'=>'<label><span class="mandatory">*</span> Payment Quantity</label>','label'=>false));
		echo $this->Form->input('payment_amount',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control PaymentValue','between'=>'<label><span class="mandatory">*</span> Payment Amount</label>','label'=>false));
		echo $this->Form->input('payment_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Payment Date</label>','label'=>false));
		echo $this->Form->input('payment_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Payment Method</label>','label'=>false));
	?>
    </div>
    <div class="col-md-6">
    	<div id="invoiceForm"></div>
	</div>
</div>

     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1')); echo $this->Form->end();	?>
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
	
</script>
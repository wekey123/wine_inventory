<?php  $ServerBaseURL = Configure::read('ServerBaseURL');?>

<div class="content-wrapper" style="min-height:0px;">
    <div class="container">
    <?php echo $this->Form->create('Shipping',array('id'=>'inventoryAdd','type' => 'file','role'=>'form')); ?>
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Shipment Entry'); ?></h1> 
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

                
    
				<div id="preloadForm" style="position:relative; top:75px; margin-left:45%; display:none"><img src="<?php echo $ServerBaseURL; ?>/img/preloader.gif" width=""  /></div>
    			
                <div id="invoiceForm"></div>
            
        
</div>
</div>
<script>
$('#VendorType').on('change',function(e){
		$('#VendorCatType').html('');
		$.ajax({
			  type: 'POST',
			  url: '<?php echo $ServerBaseURL.'/shippings/invoicelist'; ?>',//whatever any url
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
	$('#preloadForm').show();
	 if($(this).val()){
		 
		 $('.invoiceFormAll').show();
	 $('#invoiceForm').html('');$('#error_msg_no').html('');
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $ServerBaseURL.'/shippings/ajax'; ?>',//whatever any url
		  data: {label: $(this).val()},
		  success: function(message) {
			  $('#preloadForm').hide();
			  $('#invoiceForm').append(message);
		   }
	   });
	    }else{
		 $('#error_msg_no').html('');$('.invoiceFormAll').hide();$('#invoiceForm').html('');
		}
 });
</script>
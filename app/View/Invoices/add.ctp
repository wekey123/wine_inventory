   <?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); 
   $ServerBaseURL = Configure::read('ServerBaseURL');
   ?>
   
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
#error_msg{
	font-size: 13px;
    font-weight: 200;
    margin-left: 30%;
}
</style>
<div class="content-wrapper" style="min-height:0px;">
    <div class="container">
    <?php echo $this->Form->create('Invoice',array('id'=>'invoiceAdd','role'=>'form')); ?>
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Invoice Entry'); ?></h1> 
            </div>
              <div class="col-md-12"><span id="error_msg_no" style="color:red"></span></div>
        </div>
     <div class="row">
     <div class="col-md-5" style="margin-right:10%;"> 
               <?php echo $this->Form->input('vendor_id',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$vendor, 'id'=>'VendorType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the Vendor",'between'=>'<label><span class="mandatory">*</span> Vendor Name</label>','label'=>false));?>
            </div>
     <div class="col-md-5"> 
               <?php echo $this->Form->input('po_no',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>'', 'id'=>'VendorCatType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the VendorType",'between'=>'<label><span class="mandatory">*</span> Order Lists</label>','label'=>false));?>
            </div>
     </div>           
    <div class="row invoiceFormAll" style="display:none">
    
     <div class="col-md-12">
                <h1 class="page-head-line" style="font-size:16px;"><?php echo __('Invoice Form'); ?> <span id="error_msg"></span></h1> 
            </div>
    
        <div class="col-md-5" style="margin-right:10%;">               

	<?php
		//echo $this->Form->input('po_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control poVal','id'=>'tags','between'=>'<label><span class="mandatory">*</span> Order Number</label>','label'=>false));
		echo $this->Form->input('invoice_no',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','id'=>'InvoiceChk','rel'=>0,'between'=>'<label><span class="mandatory">*</span> Invoice Number</label>','label'=>false));
		echo $this->Form->input('invoice_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Invoice Date</label>','label'=>false));
		//echo $this->Form->input('vendor_name',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		//echo $this->Form->input('vendor_address',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		
		echo $this->Form->input('customer_id',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label> Customer Number</label>','label'=>false));
		echo $this->Form->input('shipping_method',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Shipping Method</label>','label'=>false));
		
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('total_price',array('div'=>false,'error'=>false,'type'=>'hidden','id'=>'total_price'));
		echo $this->Form->input('total_quantity',array('div'=>false,'error'=>false,'type'=>'hidden','id'=>'total_quantity'));
		
	?>
	</div>
    	<div class="col-md-5"> 
   		<?php 
			
		echo $this->Form->input('estimated_shipping_date',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label><span class="mandatory">*</span> Estimated Shipping Date</label>','label'=>false));
		echo $this->Form->input('payment_terms',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		
		?>
    </div>
	</div>
		<div class="row invoiceFormAll" style="display:none">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<div class="panel-heading"><label style="color:#a94442">More Invoice Coloumns </label><span class="error_msg_var"></span> <a id="invoiceAddColoumn" class="btn btn-primary addmore">Add More Coloumns</a><!--<span class="varient-enable glyphicon glyphicon-plus"></span>--></div>              
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
        <div class="row invoiceFormAll" style="display:none">
            <div class="col-md-12">
        
        
     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'submitButton1')); echo $this->Form->end();	?>
      </div>
        </div>
</div>
</div>
<input type="hidden" name="" id="countValues" value="1" />
<input type="hidden" value="<?php echo $ServerBaseURL.'/invoices/orderlist'; ?>" id="vendorListURL"  />
<input type="hidden" value="<?php echo $ServerBaseURL.'/invoices/ajax'; ?>" id="ajaxURL"  />
<?php echo $this->Html->script('inventory'); ?>
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
    			<?php  echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui');	?>
                <div id="invoiceForm"></div>
            
        
</div>
</div>
<input type="hidden" value="<?php echo $ServerBaseURL.'/shippings/invoicelist'; ?>" id="vendorListURL"  />
<input type="hidden" value="<?php echo $ServerBaseURL.'/shippings/ajax'; ?>" id="ajaxURL"  />
<?php echo $this->Html->script('inventory');?>
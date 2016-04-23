 <?php echo $this->Html->css('jquery-ui.css'); echo $this->Html->script('jquery-1.10.2'); echo $this->Html->script('jquery-ui');  $ServerBaseURL = Configure::read('ServerBaseURL'); ?>
<div class="content-wrapper">
    <div class="container">
    <?php echo $this->Form->create('Product',array('id'=>'userAdd','type' => 'file','role'=>'form','method'=>'post')); ?>
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Product'); ?> </h1>
            </div>
        </div>
                
    <div class="row">
        <div class="col-md-5" style="margin-right:10%;">               

	<?php
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		//echo $this->Form->input('category_name',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$category, 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Category Name</label>','label'=>false));
		echo $this->Form->input('vendor_id',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$vendor, 'id'=>'VendorType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the Vendor",'between'=>'<label><span class="mandatory">*</span> Vendor Name</label>','label'=>false));
		echo $this->Form->input('vendor_type',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>'', 'id'=>'VendorCatType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',"empty" => "Select the VendorType",'between'=>'<label><span class="mandatory">*</span> Vendor Type</label>','label'=>false));
		//echo $this->Form->input('category_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('status',array('div'=>false,'error'=>false,'type'=>'hidden',));
		echo $this->Form->input('title',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Title</label>','label'=>false));
		echo $this->Form->input('description',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		
	?>
	</div>
    <div class="col-md-5"> 
    <?php 
	echo $this->Form->input('image',array('div'=>false,'error'=>false,'type'=>'file', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Image</label>','label'=>false));
	//echo $this->Form->input('Vary.sellable_price',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span>Price (Retail)</label>','label'=>false));
	echo $this->Form->input('expiry',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control datepicker','between'=>'<label> Expiry Date</label>','label'=>false));
		
	echo $this->Form->input('country',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
	echo $this->Form->input('brand',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
	echo $this->Form->input('location',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('flavor',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('label',array('div'=>false,'error'=>false,'type'=>'hidden'));
		?>
    </div>
</div>
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<div class="panel-heading">Varients <span class="error_msg_var"></span> <!--<a id="test" class="btn btn-primary addmore">Add More Varients</a><span class="varient-enable glyphicon glyphicon-plus"></span>--></div>              
                <div class="panel-body" id="varient_body">           
                
               
                 <div class="form-group varHead">
                 
                 
                <!-- <input type="text" id="vname" value="" class="form-control" name=""  ><input type="text" id="sku" value="" class="form-control" name="data[Vary][val][0][sku]" ><input type="text" id="barcode" value="" class="form-control" name="data[Vary][val][0][barcode]" ><input type="text" id="Price" value="" class="form-control" name="data[Vary][val][0][price]" >-->
                 
                 <?php 
				 $metric=array('lb'=>'lb','ltr' =>'ltr','ml'=>'ml' ,'oz'=>'oz','kg'=>'kg','g'=>'g');
				 $type=array('Unit'=>'Unit','Case'=>'Case');
				 echo $this->Form->input('Vary.variant',array('div'=>false,'error'=>false,'label'=>false,'type'=>'text', 'before' => '<div class="form-group varHead col-md-2">', 'after' => '</div>', 'class'=>'validate[required] form-control','name'=>'data[Vary][val][0][variant]','id'=>'varient0','between'=>'<label>Size</label>','label'=>false));
				 
				 echo $this->Form->input('Vary.metric',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$metric, 'id'=>'metric0', 'before' => '<div class="form-group col-md-1">', 'after' => '</div>' , 'class'=>'validate[required] form-control varHead','between'=>'<label>Metric</label>','label'=>false,"empty" => "Select the Size",'name'=>'data[Vary][val][0][metric]'));
				 
				 echo $this->Form->input('Vary.qty_type',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$type, 'id'=>'VarientrQtyType', 'before' => '<div class="form-group col-md-1">', 'after' => '</div>' , 'class'=>'validate[required] form-control varHead','between'=>'<label>Qty Type</label>','label'=>false,"empty" => "Select the Size",'name'=>'data[Vary][val][0][qty_type]','rel'=>0));
				 
				 echo $this->Form->input('Vary.qty',array('div'=>false,'error'=>false,'label'=>false,'type'=>'text', 'before' => '<div class="form-group varHead col-md-1">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label>No of Qty</label>','label'=>false,'name'=>'data[Vary][val][0][qty]','id'=>'qty0','value'=>1));
				 
				 echo $this->Form->input('Vary.sku',array('div'=>false,'error'=>false,'label'=>false,'type'=>'text', 'before' => '<div class="form-group varHead col-md-2">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label>SKU</label>','label'=>false,'name'=>'data[Vary][val][0][sku]','id'=>'sku0'));
				 
				 echo $this->Form->input('Vary.barcode',array('div'=>false,'error'=>false,'label'=>false,'type'=>'text', 'before' => '<div class="form-group varHead col-md-2">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label>Bar Code</label>','label'=>false,'name'=>'data[Vary][val][0][barcode]','id'=>'barcode0'));
				 
				 echo $this->Form->input('Vary.price',array('div'=>false,'error'=>false,'label'=>false,'type'=>'text', 'before' => '<div class="form-group varHead  col-md-1" style="width:13%">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label>Price (Wholesale)</label>','label'=>false,'name'=>'data[Vary][val][0][price]','id'=>'price0'));
				 
				  echo $this->Form->input('Vary.sellable_price',array('div'=>false,'error'=>false,'label'=>false,'type'=>'text', 'before' => '<div class="form-group varHead  col-md-1" style="width:11%">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label>Price (Retail)</label>','label'=>false,'name'=>'data[Vary][val][0][sellable_price]','id'=>'price0'));
				?>
                 
                 </div>
                 <div id='TextBoxesGroup'>	</div>
                </div>
            </div>
        </div>
    </div>
    <div id="varient-wrapper"></div>
     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>
</div>
<input type="hidden" name="" id="countValues" value="1" />
<input type="hidden" name="" id="vendorListURL" value="<?php echo $ServerBaseURL.'/products/ajax'; ?>" />
<?php echo $this->Html->script('inventory'); ?>
<script>
	$('#VarientrQtyType').on('change',function(e){
		if($(this).val()== 'Case')
		$('#qty'+$(this).attr('rel')).val('');
		else
		$('#qty'+$(this).attr('rel')).val(1);
		 
	});
</script>
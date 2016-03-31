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
    <?php echo $this->Form->create('Product',array('id'=>'userAdd','type' => 'file','role'=>'form')); ?>
      <div class="row">
            <div class="col-md-12">
            <?php echo $this->Html->link('View Product', array('action' => 'view', $this->request->data['Product']['id']),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
           <h1 class="page-head-line"><?php echo __('Edit Product'); ?> </h1>  
            </div>
        </div>
                
    <div class="row" style="margin-bottom: 40px;">
        <div class="col-md-5" style="margin-right:10%;">               

	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('category_name',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$category, 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Category Name</label>','label'=>false));
		echo $this->Form->input('vendor_id',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$vendor, 'id'=>'VendorType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Vendor Name</label>','label'=>false));
		echo $this->Form->input('vendor_type',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$vendorCat, 'id'=>'VendorCatType', 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Vendor Type</label>','label'=>false));
		//echo $this->Form->input('category_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('status',array('div'=>false,'error'=>false,'type'=>'hidden',));
		echo $this->Form->input('title',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Title</label>','label'=>false));
		echo $this->Form->input('description',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('brand',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','between'=>'<label><span class="mandatory">*</span> Brand</label>','label'=>false));
		echo $this->Form->input('vendor',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		
		
		
	?>
	</div>
    <div class="col-md-5"> 
    <?php 
	echo $this->Form->input('country',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
	echo $this->Form->input('type',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('flavor',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('label',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('image',array('div'=>false,'error'=>false,'type'=>'file', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','required' => false));	
		echo $this->Form->input('image_edit',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>$this->request->data['Product']['image']));
		?>    
		<?php echo $this->Html->image('product/small/'.$this->request->data['Product']['image']);?>
 
    </div>

</div>
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<div class="panel-heading">Varients <span class="error_msg_var"></span> <a id="test" class="btn btn-primary addmore">Add More Varients</a><!--<span class="varient-enable glyphicon glyphicon-plus"></span>--></div>              
                <div class="panel-body" id="varient_body">           
               
                <?php $varys= $this->request->data['Vary'];
				$i=0;
				foreach($varys as $vary){
				?>
                 <div class="form-group varHead"><label>Varient Name</label><label>SKU</label><label>BarCode</label><label>Price</label></div>
                 <div class="form-group varHead">
                 <input type="text" id="varient<?php echo $i;?>" value="<?php echo $vary['variant'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][variant]"  >
                 <input type="text" id="sku<?php echo $i;?>" value="<?php echo $vary['sku'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][sku]" >
                 <input type="text" id="barcode<?php echo $i;?>" value="<?php echo $vary['barcode'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][barcode]" >
                 <input type="text" id="price<?php echo $i;?>" value="<?php echo $vary['price'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][price]" >
                 <input onclick="" type="hidden" name="data[Vary][val][<?php echo $i;?>][id]" value="<?php echo $vary['id']; ?>"  />
                 </div>
                 <?php $i++;} ?>
                 <div id='TextBoxesGroup'>	</div>
                </div>
            </div>
        </div>
    </div>
    <div id="varient-wrapper"></div>
     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>
</div>
<input type="hidden" name="" id="countValues" value="<?php echo $i; ?>" />
<?php echo $this->Html->script('inventory'); ?>
<script>
	$('#VendorType').on('change',function(e){
		$('#VendorCatType').html('');
		$.ajax({
			  type: 'POST',
			  url: '/products/ajax',  //whatever any url
			  data: {label: $(this).val()},
			  success: function(message) {
				  if(message){
					  console.log(message);
					  $('#VendorCatType').html(message);
				  }else{
					 console.log(message);
				  }
			   }
		   });
	 });
</script>
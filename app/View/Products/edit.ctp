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
                <h1 class="page-head-line"><?php echo __('Edit Product'); ?> </h1>
            </div>
        </div>
                
    <div class="row">
        <div class="col-md-5" style="margin-right:10%;">               

	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('category_name',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>$category, 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control'));
		//echo $this->Form->input('category_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
		echo $this->Form->input('status',array('div'=>false,'error'=>false,'type'=>'hidden',));
		echo $this->Form->input('title',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('description',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('brand',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('vendor',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		
		
		
	?>
	</div>
    <div class="col-md-5"> 
    <?php 
	echo $this->Form->input('country',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
	echo $this->Form->input('type',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('flavor',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('label',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('image',array('div'=>false,'error'=>false,'type'=>'file', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Html->image('product/home/'.$this->request->data['Product']['image']);
		//echo $this->Form->input('edit_image',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>$this->request->data['Product']['image']));
		?>
    </div>
</div>
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<div class="panel-heading">Varients <!--<span class="varient-enable glyphicon glyphicon-plus"></span>--></div>              
                <div class="panel-body" id="varient_body">           
                <a id="test">Add More Varients</a>
                <?php $varys= $this->request->data['Vary'];
				$i=0;
						foreach($varys as $vary){
				?>
                 <div class="form-group varHead"><label>Varient Name</label><label>SKU</label><label>BarCode</label><label>Price</label></div>
                 <div class="form-group varHead">
                 <input type="text" id="vname<?php echo $i;?>" value="<?php echo $vary['variant'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][variant]"  >
                 <input type="text" id="sku<?php echo $i;?>" value="<?php echo $vary['sku'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][sku]" >
                 <input type="text" id="barcode<?php echo $i;?>" value="<?php echo $vary['barcode'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][barcode]" >
                 <input type="text" id="Price<?php echo $i;?>" value="<?php echo $vary['price'];?>" class="form-control" name="data[Vary][val][<?php echo $i;?>][price]" >
                 <input type="hidden" name="data[Vary][val][<?php echo $i;?>][id]" value="<?php echo $vary['id']; ?>"  />
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
<script>
 var counter = <?php echo $i ?>;
	 $('#test').on('click',function(e){
			if(counter>10){
					alert("Only 10 textboxes allow");
					return false;
			}else{
			var newTextBoxDiv = $(document.createElement('div'))
				 .attr("id", 'TextBoxDiv' + counter);
						
			newTextBoxDiv.after().html('<div class="form-group varHead"><label>Varient</label><label>SKU</label><label>BarCode</label><label>Price</label></div><div class="form-group varHead"><input type="text" id="varient' + counter + '" value="" class="form-control"  ><input type="text" id="sku' + counter + '" value="" class="form-control" ><input type="text" id="barcode' + counter + '" value="" class="form-control" ><input type="text" id="price' + counter + '" value="" class="form-control" style="margin-right:1%" > <a class="testremove" rel="' + counter + '">remove</a></div>');
					
			newTextBoxDiv.appendTo("#TextBoxesGroup");
			counter++;
		  }
	 });
	 $('.testremove').on('click',function(){alert($(this).attr('rel'));
		 $("#TextBoxDiv" + $(this).attr('rel')).remove();
	 });
	  $("#getVarientValue").click(function () {
			 var arr = [];
				var price,sku,barcode,Varoptions,newDiv;
				for(i=1; i<counter; i++){
					varient = $('#varient' + i).val();
					price = $('#price' + i).val();
					sku=  $('#sku' + i).val();
					barcode = $('#barcode' + i).val();
					newDiv = $(document.createElement('div')).attr("id", 'ProductVarientPrice' + i);
					newDiv.after().html('<input type="hidden" name="data[Vary][val]['+i+'][price]" value="'+price+'"><input type="hidden" name="data[Vary][val]['+i+'][sku]" value="'+sku+'"><input type="hidden" name="data[Vary][val]['+i+'][barcode]" value="'+barcode+'"><input type="hidden" name="data[Vary][val]['+i+'][variant]" value="'+varient+'">');
					newDiv.appendTo("#varient-wrapper");
				}
				//alert($('#varient-wrapper').html());
				//return false;
		});
</script>
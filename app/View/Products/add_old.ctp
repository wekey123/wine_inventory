<div id="page-wrapper">
<?php echo $this->Form->create('Product'); ?>
<div class="addNewButton" style="float:none;">
         <?php echo $this->Html->link(__('Back to Product'), array('action' => 'index'),array('class' => 'btn btn-primary','type'=>'button')); ?>
        
    </div>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
        <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
            	<div class="panel-heading">Products</div>              
                <div class="panel-body"> 
	<?php
		//echo $this->Form->input('user_id');
		echo $this->Form->input('title',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('description',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('vendor',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('type',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('tags',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>'0'));
		echo $this->Form->input('publish',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>'1'));
		echo $this->Form->input('price',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('list_price',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('sku',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('barcode',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('quantity',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('weight',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('variants',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('attributes',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0,'id'=>'tagVarients'));
		echo $this->Html->tag('label', 'Variants');
						echo $this->Html->tag('ul', '', array('id'=>'eventTags'));
		echo $this->Html->tag('label', 'Values');
						echo $this->Html->tag('ul', '', array('id'=>'mySingleFieldTags'));
		echo $this->Form->input('values',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0,'id'=>'tagValues'));
		//echo $this->Form->input('tax',array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>'));
		//echo $this->Form->input('shipping',array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>'));
		//echo $this->Form->input('published_at');
		//echo $this->Form->input('updated_at');
	?></div>
            </div>
		</div>
    </div>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>


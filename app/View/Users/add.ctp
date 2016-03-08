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
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Users'); ?> </h1>
            </div>
        </div>
                
    <div class="row">
        <div class="col-md-5" style="margin-right:10%;">     
	<?php echo $this->Form->create('User'); ?>
	<?php
		echo $this->Form->input('username',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('password',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('role',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>array('admin' => 'Admin', 'author' => 'Author'), 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control'));
	?>
    <div id="varient-wrapper"></div>
     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>
</div>

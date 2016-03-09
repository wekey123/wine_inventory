<style>
.heading{
	    font-weight: bold;
}
</style>
<div class="content-wrapper">
   <div class="container">
   
   
<div class="row">

       <div class="col-md-12">
            <?php echo $this->Html->link('Edit Profile', array('action' => 'edit', $user['User']['id']),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">View Profile</h4>
        </div>

		<div class="col-md-12">
            <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h4>
          </div>
          
		<div class="col-md-10">
       <!-- <div class="row">
            <div class="col-md-2 heading"><?php echo __('Id'); ?></div>
            <div class="col-md-8"><?php echo h($user['User']['id']); ?></div>
        </div>-->
        
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Username'); ?></div>
            <div class="col-md-8"><?php echo h($user['User']['username']); ?></div>
        </div>
        
        
        <!--<div class="row">
            <div class="col-md-2 heading"><?php echo __('Password'); ?></div>
            <div class="col-md-8"><?php echo h($user['User']['password']); ?></div>
        </div>-->
        
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Role'); ?></div>
            <div class="col-md-8"><?php echo h($user['User']['role']); ?></div>
        </div>
        
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Created'); ?></div>
            <div class="col-md-8"><?php echo h($user['User']['created']); ?></div>
        </div>
        
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Modified'); ?></div>
            <div class="col-md-8"><?php echo h($user['User']['modified']); ?></div>
        </div>
</div>
		
</div>

<?php /*?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
	</ul>
</div><?php */?>

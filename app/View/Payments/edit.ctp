<div class="payments form">
<?php echo $this->Form->create('Payment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Payment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('po_no');
		echo $this->Form->input('invoice_no');
		echo $this->Form->input('payment_no');
		echo $this->Form->input('payment_amount');
		echo $this->Form->input('payment_date');
		echo $this->Form->input('payment_method');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Payment.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Payment.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Payments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Invoices'), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
	</ul>
</div>

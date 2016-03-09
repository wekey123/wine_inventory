<div class="invoices index">
	<h2><?php echo __('Invoices'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('po_no'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_date'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_name'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_address'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('shipping_method'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_terms'); ?></th>
			<th><?php echo $this->Paginator->sort('estimated_shipping_date'); ?></th>
			<th><?php echo $this->Paginator->sort('total_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('total_price'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($invoices as $invoice): ?>
	<tr>
		<td><?php echo h($invoice['Invoice']['id']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['product_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($invoice['Order']['id'], array('controller' => 'orders', 'action' => 'view', $invoice['Order']['id'])); ?>
		</td>
		<td><?php echo h($invoice['Invoice']['invoice_no']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['invoice_date']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['vendor_name']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['vendor_address']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['customer_id']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['shipping_method']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['payment_terms']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['estimated_shipping_date']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['total_quantity']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['total_price']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['created']); ?>&nbsp;</td>
		<td><?php echo h($invoice['Invoice']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $invoice['Invoice']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $invoice['Invoice']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $invoice['Invoice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $invoice['Invoice']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Invoice'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
	</ul>
</div>

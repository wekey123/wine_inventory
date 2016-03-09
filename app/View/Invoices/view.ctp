<div class="invoices view">
<h2><?php echo __('Invoice'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Id'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['product_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invoice['Order']['id'], array('controller' => 'orders', 'action' => 'view', $invoice['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice No'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['invoice_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice Date'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['invoice_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor Name'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['vendor_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor Address'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['vendor_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Id'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['customer_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping Method'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['shipping_method']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Terms'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['payment_terms']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estimated Shipping Date'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['estimated_shipping_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Quantity'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['total_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Price'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['total_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($invoice['Invoice']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Invoice'), array('action' => 'edit', $invoice['Invoice']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Invoice'), array('action' => 'delete', $invoice['Invoice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $invoice['Invoice']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Varies'); ?></h3>
	<?php if (!empty($invoice['Vary'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Variant'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Barcode'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Po No'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($invoice['Vary'] as $vary): ?>
		<tr>
			<td><?php echo $vary['id']; ?></td>
			<td><?php echo $vary['product_id']; ?></td>
			<td><?php echo $vary['variant']; ?></td>
			<td><?php echo $vary['sku']; ?></td>
			<td><?php echo $vary['barcode']; ?></td>
			<td><?php echo $vary['price']; ?></td>
			<td><?php echo $vary['quantity']; ?></td>
			<td><?php echo $vary['type']; ?></td>
			<td><?php echo $vary['po_no']; ?></td>
			<td><?php echo $vary['created']; ?></td>
			<td><?php echo $vary['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'varies', 'action' => 'view', $vary['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'varies', 'action' => 'edit', $vary['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'varies', 'action' => 'delete', $vary['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vary['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Payments'); ?></h3>
	<?php if (!empty($invoice['Payment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Po No'); ?></th>
		<th><?php echo __('Invoice No'); ?></th>
		<th><?php echo __('Payment No'); ?></th>
		<th><?php echo __('Payment Amount'); ?></th>
		<th><?php echo __('Payment Date'); ?></th>
		<th><?php echo __('Payment Method'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($invoice['Payment'] as $payment): ?>
		<tr>
			<td><?php echo $payment['id']; ?></td>
			<td><?php echo $payment['user_id']; ?></td>
			<td><?php echo $payment['po_no']; ?></td>
			<td><?php echo $payment['invoice_no']; ?></td>
			<td><?php echo $payment['payment_no']; ?></td>
			<td><?php echo $payment['payment_amount']; ?></td>
			<td><?php echo $payment['payment_date']; ?></td>
			<td><?php echo $payment['payment_method']; ?></td>
			<td><?php echo $payment['created']; ?></td>
			<td><?php echo $payment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'payments', 'action' => 'view', $payment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'payments', 'action' => 'edit', $payment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'payments', 'action' => 'delete', $payment['id']), array('confirm' => __('Are you sure you want to delete # %s?', $payment['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

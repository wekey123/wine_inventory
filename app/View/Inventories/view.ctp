<div class="inventories view">
<h2><?php echo __('Inventory'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['User']['id'], array('controller' => 'users', 'action' => 'view', $inventory['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['Order']['id'], array('controller' => 'orders', 'action' => 'view', $inventory['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice No'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['invoice_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product  No'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['product _no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment No'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['payment_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping No'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['shipping_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Quantity'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['total_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Price'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['total_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inventory'), array('action' => 'edit', $inventory['Inventory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Inventory'), array('action' => 'delete', $inventory['Inventory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $inventory['Inventory']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shippings'), array('controller' => 'shippings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shipping'), array('controller' => 'shippings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices'), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Payments'); ?></h3>
	<?php if (!empty($inventory['Payment'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Po No'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['po_no']; ?>
&nbsp;</dd>
		<dt><?php echo __('Invoice No'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['invoice_no']; ?>
&nbsp;</dd>
		<dt><?php echo __('Payment No'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['payment_no']; ?>
&nbsp;</dd>
		<dt><?php echo __('Payment Amount'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['payment_amount']; ?>
&nbsp;</dd>
		<dt><?php echo __('Payment Date'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['payment_date']; ?>
&nbsp;</dd>
		<dt><?php echo __('Payment Method'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['payment_method']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $inventory['Payment']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Payment'), array('controller' => 'payments', 'action' => 'edit', $inventory['Payment']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Shippings'); ?></h3>
	<?php if (!empty($inventory['Shipping'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Po No'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['po_no']; ?>
&nbsp;</dd>
		<dt><?php echo __('Invoice No'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['invoice_no']; ?>
&nbsp;</dd>
		<dt><?php echo __('Shipping No'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['shipping_no']; ?>
&nbsp;</dd>
		<dt><?php echo __('Shipping Quantity'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['shipping_quantity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Defective Quantity'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['defective_quantity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Missing Quantity'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['missing_quantity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Shipping Method'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['shipping_method']; ?>
&nbsp;</dd>
		<dt><?php echo __('Tracking No'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['tracking_no']; ?>
&nbsp;</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['weight']; ?>
&nbsp;</dd>
		<dt><?php echo __('Received Date'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['received_date']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $inventory['Shipping']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Shipping'), array('controller' => 'shippings', 'action' => 'edit', $inventory['Shipping']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Varies'); ?></h3>
	<?php if (!empty($inventory['Vary'])): ?>
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
	<?php foreach ($inventory['Vary'] as $vary): ?>
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
	<h3><?php echo __('Related Invoices'); ?></h3>
	<?php if (!empty($inventory['Invoice'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Po No'); ?></th>
		<th><?php echo __('Invoice No'); ?></th>
		<th><?php echo __('Invoice Date'); ?></th>
		<th><?php echo __('Vendor Name'); ?></th>
		<th><?php echo __('Vendor Address'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Shipping Method'); ?></th>
		<th><?php echo __('Payment Terms'); ?></th>
		<th><?php echo __('Estimated Shipping Date'); ?></th>
		<th><?php echo __('Total Quantity'); ?></th>
		<th><?php echo __('Total Price'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($inventory['Invoice'] as $invoice): ?>
		<tr>
			<td><?php echo $invoice['id']; ?></td>
			<td><?php echo $invoice['user_id']; ?></td>
			<td><?php echo $invoice['product_id']; ?></td>
			<td><?php echo $invoice['po_no']; ?></td>
			<td><?php echo $invoice['invoice_no']; ?></td>
			<td><?php echo $invoice['invoice_date']; ?></td>
			<td><?php echo $invoice['vendor_name']; ?></td>
			<td><?php echo $invoice['vendor_address']; ?></td>
			<td><?php echo $invoice['customer_id']; ?></td>
			<td><?php echo $invoice['shipping_method']; ?></td>
			<td><?php echo $invoice['payment_terms']; ?></td>
			<td><?php echo $invoice['estimated_shipping_date']; ?></td>
			<td><?php echo $invoice['total_quantity']; ?></td>
			<td><?php echo $invoice['total_price']; ?></td>
			<td><?php echo $invoice['created']; ?></td>
			<td><?php echo $invoice['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invoices', 'action' => 'view', $invoice['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invoices', 'action' => 'edit', $invoice['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invoices', 'action' => 'delete', $invoice['id']), array('confirm' => __('Are you sure you want to delete # %s?', $invoice['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

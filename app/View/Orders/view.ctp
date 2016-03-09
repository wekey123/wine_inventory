<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line"><?php echo __('Order'); ?></h4>

                </div>

            </div><?php //echo '<pre>';print_r($order); ?>
            <?php foreach ($order as $order) {?>
          		  <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                               <strong><?php echo __('Order Number'); ?></strong> <span> : </span> <span><?php echo h($order['Order']['po_no']); ?></span> <br />
                               <strong><?php echo __('Total Quantity'); ?></strong> <span> : </span> <span><?php echo h($order['Order']['total_quantity']); ?></span> <br />
                               <strong><?php echo __('Total Price'); ?></strong> <span> : </span> <span><?php echo h($order['Order']['total_price']); ?></span> <br />
                               <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php echo h($order['Order']['user_id']); ?></span> <br />
                               <strong><?php echo __('Created On'); ?></strong> <span> : </span> <span><?php echo h($order['Order']['created']); ?></span> <br />
                            </div>
                        </div>
            		</div>
                    
                    <div class="row">	
 					 	<div class="col-md-12">
                         <!--    Hover Rows  -->
                                <div class="panel panel-default">
                            		<div class="panel-heading">
									   <?php echo __('Products'); ?>
                                    </div>
                            		<div class="panel-body">
                                        <div class="table-responsive">
                							<strong><?php echo __('Product Name'); ?></strong> <span> : </span> <span><?php echo h($order['Product']['title']); ?></span> <br />
                               <strong><?php echo __('Category'); ?></strong> <span> : </span> <span><?php echo h($order['Product']['category_name']); ?></span> <br />
                               <strong><?php echo __('Vendor'); ?></strong> <span> : </span> <span><?php echo h($order['Product']['vendor']); ?></span> <br />
                               <strong><?php echo __('country'); ?></strong> <span> : </span> <span><?php echo h($order['Product']['country']); ?></span> <br />
                               <strong><?php echo __('Image'); ?></strong> <span> : </span> <span><img src="/img/product/small/<?php echo h($order['Product']['image']); ?>" height="" width="" /></span> <br />
                
                                        </div>
                                    </div>
                        		</div>
                        <!-- End  Hover Rows  -->
                		</div>
    				</div>
                    
                    
                    
            <?php } ?>
        </div>
    </div>
    
    
    
<h2><?php echo __('Order'); ?></h2>

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Product']['title'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Po No'); ?></dt>
		<dd>
			<?php echo h($order['Order']['po_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Quantity'); ?></dt>
		<dd>
			<?php echo h($order['Order']['total_quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Price'); ?></dt>
		<dd>
			<?php echo h($order['Order']['total_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($order['Order']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices'), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Invoices'); ?></h3>
	<?php if (!empty($order['Invoice'])): ?>
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
	<?php foreach ($order['Invoice'] as $invoice): ?>
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
<div class="related">
	<h3><?php echo __('Related Varies'); ?></h3>
	<?php if (!empty($order['Vary'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Vary Id'); ?></th>
		<th><?php echo __('Variant'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Barcode'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($order['Vary'] as $vary): ?>
		<tr>
			<td><?php echo $vary['id']; ?></td>
			<td><?php echo $vary['product_id']; ?></td>
			<td><?php echo $vary['vary_id']; ?></td>
			<td><?php echo $vary['variant']; ?></td>
			<td><?php echo $vary['sku']; ?></td>
			<td><?php echo $vary['barcode']; ?></td>
			<td><?php echo $vary['price']; ?></td>
			<td><?php echo $vary['type']; ?></td>
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

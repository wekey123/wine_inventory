 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Invoices</h4>
        </div>
        <div class="col-md-12">
        <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h4>
         <a href="invoices/add" class="btn btn-primary" style="margin-bottom:20px; float:right">Add Invoice</a>
         </div>
     </div>
 	<div class="row">	
 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo __('Invoices List'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
	
	<table cellpadding="0" cellspacing="0" class="table table-hover">
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
	</div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
    </div>
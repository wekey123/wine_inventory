 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Order Lists</h4>
        </div>
        <div class="col-md-12">
         <a href="orders/add" class="btn btn-primary" style="margin-bottom:20px; float:right">Order Products</a>
          </div>
     </div>
 	<div class="row">	
 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo __('Orders'); ?>
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
			<th><?php echo $this->Paginator->sort('total_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('total_price'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php $i=0;foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['user_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($order['Product']['title'], array('controller' => 'products', 'action' => 'view', $order['Product']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['po_no']); ?>&nbsp;</td>
		<td><?php echo h($order[0]['total_quantity']); ?>&nbsp;</td>
		<td><?php echo h($order[0]['total_price']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['created']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'], $order['Order']['po_no'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?>
		</td>
	</tr>
<?php $i++; endforeach; ?>
	</tbody>
	</table>
	
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
    </div>

</div>
</div>
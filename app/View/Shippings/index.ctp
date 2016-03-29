 <?php echo $this->element('tableScript'); ?>
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
        <?php echo $this->Html->link('Add Shipping', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Shipping</h4>
        </div>
        <div class="col-md-12">
        <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h4>
         </div>
     </div>
 	<div class="row">	
 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo __('Shipping List'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x:hidden;">
	 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
	<tr>
			<th>#</th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('po_no'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('shipping_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('unshipped_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('shipping_method'); ?></th>
			<th><?php echo $this->Paginator->sort('received_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php $i =0; foreach ($shippings as $shipping): ?>
	<tr>
		<td><?php echo h($i); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['po_no']); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['invoice_no']); ?>&nbsp;</td>
        <td><?php echo h($shipping['Shipping']['invoice_quantity']); ?>&nbsp;</td>
		<td><?php echo h($shipping[0]['shipping_quantity']); ?>&nbsp;</td>
		<td><?php echo h($shipping[0]['unshipped_quantity']); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['shipping_method']); ?>&nbsp;</td>
        <td><?php echo h($shipping['Shipping']['received_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shipping['Shipping']['po_no'])); ?> | 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $shipping['Shipping']['po_no'])); ?>
			<?php /*?><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $shipping['Shipping']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $shipping['Shipping']['id']))); ?><?php */?>
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
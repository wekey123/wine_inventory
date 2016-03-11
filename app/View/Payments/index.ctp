 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
             <?php echo $this->Html->link('Add Payment', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Payment</h4>
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
                           <?php echo __('Payments List'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
									<table cellpadding="0" cellspacing="0" class="table table-hover">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('#'); ?></th>
			<?php /*?><th><?php echo $this->Paginator->sort('po_no'); ?></th><?php */?>
			<th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_no'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_date'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id','Created By'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<?php /*?><th><?php echo $this->Paginator->sort('modified'); ?></th><?php */?>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($payment['Payment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Payment']['invoice_no'], array('controller' => 'invoices', 'action' => 'view', $payment['Payment']['invoice_no'])); ?>
		</td>
		<td><?php echo h($payment['Payment']['payment_no']); ?>&nbsp;</td>
		<td><?php echo $this->Util->currencyFormat($payment['Payment']['payment_amount']); ?>&nbsp;</td>
		<td><?php echo $this->Util->DateOnlyFormat($payment['Payment']['payment_date']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['payment_method']); ?>&nbsp;</td>
        <td><?php echo h($payment['User']['username']); ?>&nbsp;</td>
		<td><?php echo $this->Util->DateFormat($payment['Payment']['created']); ?>&nbsp;</td>
<?php /*?>		<td><?php echo $this->Util->DateFormat($payment['Payment']['modified']); ?>&nbsp;</td><?php */?>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['id'])); ?>
			<?php /*?><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $payment['Payment']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $payment['Payment']['id']))); ?><?php */?>
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
	
 <?php echo $this->element('tableScript'); ?>
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
             <?php echo $this->Html->link('Add Payment', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Payment List</h4>
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
                           <div class="table-responsive" style="overflow-x:hidden;">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('#'); ?></th>
			<th><?php echo $this->Paginator->sort('po_no','P.O.No'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
			<?php /*?><th><?php echo $this->Paginator->sort('payment_no'); ?></th><?php */?>
            <th><?php echo $this->Paginator->sort('payment_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_amount'); ?></th>
			<?php /*?><th><?php echo $this->Paginator->sort('payment_date'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method'); ?></th><?php */?>
            <th><?php echo $this->Paginator->sort('user_id','Created By'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php $i =1; foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($i); ?> </td>
        <td>
			<?php echo $this->Html->link($payment['Payment']['po_no'], array('controller' => 'orders', 'action' => 'view', $payment['Payment']['po_no'])); ?>
        </td>
		<td>
			<?php echo $this->Html->link($payment['Payment']['invoice_no'], array('controller' => 'invoices', 'action' => 'view', $payment['Payment']['invoice_no'])); ?>
		</td>
		<?php /*?><td><?php echo h($payment['Payment']['payment_no']); ?>&nbsp;</td><?php */?>
        <td><?php echo $payment['Payment']['payment_qty']; ?>&nbsp;</td>
		<td><?php echo $this->Util->currencyFormat($payment[0]['total_amount']); ?>&nbsp;</td>
		<?php /*?><td><?php echo $this->Util->DateOnlyFormat($payment['Payment']['payment_date']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['payment_method']); ?>&nbsp;</td><?php */?>
        <td><?php echo h($payment['User']['username']); ?>&nbsp;</td>
		<td><?php echo $this->Util->DateOnlyFormat($payment['Payment']['created']); ?>&nbsp;</td>
        <td><?php echo $this->Util->DateOnlyFormat($payment['Payment']['modified']); ?>&nbsp;</td> 
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['invoice_no'])); ?> | 
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['invoice_no'])); ?>
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
	
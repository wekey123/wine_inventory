<?php echo $this->element('tableScript'); ?>
<div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
      		  <?php echo $this->Html->link('Add Inventory', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line"><?php echo __('Inventories'); ?></h4>
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
                            Products List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x:hidden;">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                	<thead>
                                <tr>
                                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                                        <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                                        <th><?php echo $this->Paginator->sort('po_no'); ?></th>
                                        <th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
                                        <th><?php echo $this->Paginator->sort('shipping_no'); ?></th>
                                        <th><?php echo $this->Paginator->sort('total_quantity'); ?></th>
                                        <th><?php echo $this->Paginator->sort('total_price'); ?></th>
                                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                                        <th><?php echo $this->Paginator->sort('modified'); ?></th>
                                        <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                                </thead>
                                	<tbody>
                                <?php foreach ($inventories as $inventory): ?>
                                <tr>
                                    <td><?php echo h($inventory['Inventory']['id']); ?>&nbsp;</td>
                                    <td>
                                        <?php echo $this->Html->link($inventory['User']['username'], array('controller' => 'users', 'action' => 'view', $inventory['User']['id'])); ?>
                                    </td>
                                    <td>
                                        <?php echo $this->Html->link($inventory['Inventory']['po_no'], array('controller' => 'orders', 'action' => 'view', $inventory['Inventory']['po_no'])); ?>
                                    </td>
                                    <td><?php echo h($inventory['Inventory']['invoice_no']); ?>&nbsp;</td>
                                    <td><?php echo h($inventory['Inventory']['shipping_no']); ?>&nbsp;</td>
                                    <td><?php echo h($inventory['Inventory']['total_quantity']); ?>&nbsp;</td>
                                    <td><?php echo h($inventory['Inventory']['total_price']); ?>&nbsp;</td>
                                    <td><?php echo h($inventory['Inventory']['created']); ?>&nbsp;</td>
                                    <td><?php echo h($inventory['Inventory']['modified']); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $inventory['Inventory']['id'], $inventory['Inventory']['po_no'], $inventory['Inventory']['invoice_no'])); ?>
                                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inventory['Inventory']['id'])); ?>
                                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $inventory['Inventory']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $inventory['Inventory']['id']))); ?>
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
	<?php /*?><p>
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
	</div><?php */?>
</div>
</div>


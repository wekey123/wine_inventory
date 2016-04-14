 <?php echo $this->element('tableScript'); ?>
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
        <?php echo $this->Html->link('Add Invoice Entry', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Invoices Entry List</h4>
            <div class="form-group">
                <label>Select Vendor</label>
                <select class="form-control" name="filterVendor" id="filterVendor">
                  <option value="" style="width:45%; float:left">Select Vendor</option>
                     <?php foreach($vendor as $key => $vend) {?>
                        <option value="<?php echo h($key); ?>"  style="width:45%; float:left"><?php echo h($vend); ?></option>
                        <?php } ?>
                </select>
            </div>
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
                           <?php echo __('Invoices Entry List'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x:hidden;">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                            <th><?php echo $this->Paginator->sort('#'); ?></th>
                                            <th><?php echo $this->Paginator->sort('po_no','PO Number'); ?></th>
                                            <th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
                                            <th><?php echo $this->Paginator->sort('invoice_date'); ?></th>
                                            <th><?php echo $this->Paginator->sort('vendor_name'); ?></th>
                                           <?php /*?> <th><?php echo $this->Paginator->sort('vendor_address'); ?></th>
                                            <th><?php echo $this->Paginator->sort('customer_id'); ?></th>
                                            <th><?php echo $this->Paginator->sort('payment_terms'); ?></th>
                                            <th><?php echo $this->Paginator->sort('shipping_method'); ?></th><?php */?>
                                            <th><?php echo $this->Paginator->sort('order_quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('invoice_quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('invoice_price'); ?></th>
                                             <?php /*?><th><?php echo $this->Paginator->sort('estimated_shipping_date','ESD'); ?></th>
                                            <th><?php echo $this->Paginator->sort('user_id','Created By'); ?></th>
                                           <th><?php echo $this->Paginator->sort('created'); ?></th>
                                            <th><?php echo $this->Paginator->sort('modified'); ?></th><?php */?>
                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody class="searchable" id="exampleBody">
                                    <?php foreach ($invoices as $invoice): ?>
                                    <tr>
                                        <td><?php echo h($invoice['Invoice']['id']); ?>&nbsp;<input type="hidden" value="<?php echo h($invoice['Invoice']['vendor_id']); ?>" /></td>
                                        <td>
                                            <?php echo $this->Html->link($invoice['Invoice']['po_no'], array('controller' => 'orders', 'action' => 'view',$invoice['Invoice']['po_no'])); ?>
                                        </td>
                                        <td><?php echo h($invoice['Invoice']['invoice_no']); ?>&nbsp;</td>
                                        <td><?php echo $this->Util->dateOnlyFormat($invoice['Invoice']['invoice_date']); ?>&nbsp;</td>
                                        <td><?php echo h($this->Util->getVendorNameAlone($invoice['Invoice']['vendor_id'])); ?>&nbsp;</td>
                                        <?php /*?><td><?php echo h($invoice['Invoice']['vendor_address']); ?>&nbsp;</td>
                                        <td><?php echo h($invoice['Invoice']['customer_id']); ?>&nbsp;</td>
                                        <td><?php echo h($invoice['Invoice']['payment_terms']); ?>&nbsp;</td><?php 
                                        <td><?php echo h($invoice['Invoice']['shipping_method']); ?>&nbsp;</td>*/?>
                                        <td><?php echo $this->Util->getOrderQuantity($invoice['Invoice']['po_no']); ?>&nbsp;</td>
                                        <td><?php echo h($invoice['Invoice']['total_quantity']); ?>&nbsp;</td>
                                        <td><?php echo $this->Util->currencyFormat($invoice['Invoice']['total_price']); ?>&nbsp;</td>
                                         <?php /*?> <td><?php echo $this->Util->dateOnlyFormat($invoice['Invoice']['estimated_shipping_date']); ?>&nbsp;</td>
                                        <td><?php echo h($invoice['User']['username']); ?>&nbsp;</td>
                                      <td><?php echo h($invoice['Invoice']['created']); ?>&nbsp;</td>
                                        <td><?php echo h($invoice['Invoice']['modified']); ?>&nbsp;</td><?php */?>
                                        <td class="actions">
                                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $invoice['Invoice']['invoice_no'])); ?> | 
                                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $invoice['Invoice']['id'])); ?> |
                                            <?php echo $this->Html->link(__('Download'), array('action' => 'report',$invoice['Invoice']['invoice_no'])); ?>
                                           <?php /*?> <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $invoice['Invoice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $invoice['Invoice']['id']))); ?><?php */?>
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
    <script>
	function filterTable(inputVal){
		if(inputVal !=''){console.log(inputVal);
		var table = $('#exampleBody');
		table.find('tr').each(function(index, row){
			$(row).hide();
			var allCells = $(row).find('input[type="hidden"]');
			if(allCells.length > 0)
			{
				allCells.each(function(index, td)
				{ console.log($(td).val());
					if($(td).val() == inputVal){
						console.log('a');
						  $(row).show();
					}
				});
				
			}
		});
		}else{console.log('no'+inputVal);
			var table = $('#example');
				table.find('tr').each(function(index, row){$(row).show();
			});
		}
		console.log(table);
		paginateTable(table);
	}
	$('#filterVendor').on('change',function(e){
		filterTable($(this).val());//paginateTable1();
	});	
</script>
 <?php echo $this->element('tableScript'); ?>
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
             <?php echo $this->Html->link('Add Payment Entry', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Payment List</h4>
            <div class="form-group">
                <label>Select Vendor</label>
                <select class="form-control" name="filterVendor" id="filterVendor">
                  <option value="ALL" style="width:45%; float:left">ALL</option>
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
            <th><?php echo $this->Paginator->sort('vendor name'); ?></th>
            <th><?php echo $this->Paginator->sort('order_quantity'); ?></th>
            <th><?php echo $this->Paginator->sort('invoice_quantity'); ?></th>
            <th><?php echo $this->Paginator->sort('payment_quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('paid_amount'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	 <tbody class="searchable" id="exampleBody">
	<?php $i =1; $total['qty'] = 0; $total['amount'] = 0; $total['invoice_qty'] = 0; $total['order_qty'] = 0; foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($i); ?><input type="hidden" value="<?php echo h($payment['Payment']['vendor_id']); ?>" /> </td>
        <td>
			<?php echo $this->Html->link($payment['Payment']['po_no'], array('controller' => 'orders', 'action' => 'view', $payment['Payment']['po_no'])); ?>
        </td>
		<td>
			<?php echo $this->Html->link($payment['Payment']['invoice_no'], array('controller' => 'invoices', 'action' => 'view', $payment['Payment']['invoice_no'])); ?>
		</td>
        <td><?php echo h($this->Util->getVendorNameAlone($payment['Payment']['vendor_id'])); ?>&nbsp;</td>
        <td><?php echo $po_qty = $this->Util->getOrderQuantity($payment['Payment']['po_no']); ?>&nbsp;</td>
        <td><?php echo $inv_qty = $this->Util->getInvoiceQuantity($payment['Payment']['invoice_no']); ?>&nbsp;</td>
        <td><?php echo $payment['Payment']['payment_qty']; //$payment['Payment']['payment_qty']; ?>&nbsp;</td>
		<td><?php echo $this->Util->currencyFormat($payment['Payment']['payment_amount']); 
		$total['invoice_qty']+=$inv_qty;
		$total['order_qty']+=$po_qty;
		$total['qty']+=$payment['Payment']['payment_qty'];
		$total['amount']+=$payment['Payment']['payment_amount'];
		 ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['invoice_no'])); ?> | 
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['invoice_no'])); ?>
		</td>
	</tr>
<?php $i++; endforeach; ?>
	<tr id="totalrow"><td colspan="4"></td><td><?php echo  $total['qty']; ?></td><td><?php echo  $total['qty']; ?></td><td><?php echo  $total['qty']; ?></td><td colspan="2"><?php echo  $this->Util->currencyFormat($total['amount']); ?></td></tr>
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
		
		var table = $('#exampleBody');
		if(inputVal !=''){console.log(inputVal);
				table.find('tr').each(function(index, row){
					$(row).hide();
					var allCells = $(row).find('input[type="hidden"]');
					if(allCells.length > 0)
					{
						allCells.each(function(index, td)
						{ 	console.log($(td).val());
							if($(td).val() == inputVal){
								console.log('a');
								  $(row).show();
							}
						});

							
						
					}
					$('#totalrow').show();
					
				});
		}else{console.log('no'+inputVal);
				table.find('tr').each(function(index, row){
					$(row).show();
				});
		}
		console.log(table);
		//paginateTable(table);
	}
	$('#filterVendor').on('change',function(e){

		filterTable($(this).val());//paginateTable1();

	});	
</script>
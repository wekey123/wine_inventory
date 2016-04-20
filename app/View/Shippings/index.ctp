 <?php echo $this->element('tableScript'); ?>
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
        <?php echo $this->Html->link('Add Shipment Entry', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Shipment Lists</h4>
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
                           <?php echo __('Shipment List'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x:hidden;">
	 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
	<tr>
			<th>#</th>
			<?php /*?><th><?php echo $this->Paginator->sort('user'); ?></th><?php */?>
			<th><?php echo $this->Paginator->sort('po_no'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
            <th><?php echo $this->Paginator->sort('invoice_qty'); ?></th>
			<th><?php echo $this->Paginator->sort('shipped_qty'); ?></th>
			<th><?php echo $this->Paginator->sort('inbound_qty'); ?></th>
            <th><?php echo $this->Paginator->sort('missing_qty'); ?></th>
            <th><?php echo $this->Paginator->sort('defect_qty'); ?></th>
			<th><?php echo $this->Paginator->sort('sellable_qty'); ?></th>
			<?php /*?><th><?php echo $this->Paginator->sort('received_date'); ?></th><?php */?>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody class="searchable" id="exampleBody">
	<?php $i =1; foreach ($shippings as $shipping): ?>
	<tr>
		<td><?php echo h($i); ?>&nbsp;</td><?php  $users = $this->Util->getUserdetails($shipping['Shipping']['user_id']); $uname= isset($users['User']['username']) ? $users['User']['username'] : '';?><input type="hidden" value="<?php echo h($shipping['Shipping']['vendor_id']); ?>" />
		<?php /*?><td><?php echo h($uname); ?>&nbsp;</td><?php */?>
		<td><?php echo h($shipping['Shipping']['po_no']); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['invoice_no']); ?>&nbsp;</td>
        <td><?php echo h($shipping['Shipping']['total_invoice_qty']); ?>&nbsp;</td>
        <td><?php echo h($shipping['Shipping']['total_ship_qty']); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['total_inb_qty']); ?>&nbsp;</td>
        <td><?php echo h($shipping['Shipping']['total_inb_ship_missing_qty']); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['total_defect_qty']); ?>&nbsp;</td>
		<td><?php echo h($shipping['Shipping']['total_sellable_qty']); ?>&nbsp;</td>
        <?php /*?><td><?php echo h($shipping['Shipping']['received_date']); ?>&nbsp;</td><?php */?>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shipping['Shipping']['invoice_no'])); ?> 
            <?php if($shipping['Shipping']['status'] == 0) { ?>| 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $shipping['Shipping']['invoice_no'])); ?>
            <?php } ?>
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
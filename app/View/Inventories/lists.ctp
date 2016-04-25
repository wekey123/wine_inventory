<?php echo $this->element('tableScript'); ?>
<script>
	$(document).ready(function() {
		$('#example1').DataTable({
			bPaginate:false
		});
	} );
</script>
<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line"><?php echo __('Inventory Details'); ?></h4>
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
                 <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h5>
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
                            <div class="table-responsive" style="overflow-x:scroll;">
                                <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->Paginator->sort('vendor'); ?></th>
                                            <th><?php echo $this->Paginator->sort('title'); ?></th>
                                            <th><?php echo $this->Paginator->sort('image'); ?></th>
                                            
                                            <th><?php echo $this->Paginator->sort('Total Order Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Invoice Quantity'); ?></th>
                                           <?php /*?> <th><?php echo $this->Paginator->sort('Total Paid Quantity'); ?></th><?php */?>
                                            <th><?php echo $this->Paginator->sort('Total Shipped Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Unshipped Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Inbound Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Inbound Missing Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Defect Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Inventory Missing Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Sellable Quantity'); ?></th>
                                            
                                            <th><?php echo $this->Paginator->sort('Total Sold Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Total Customer Return Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Return to MFG Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Unsellable Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Lost Quantity'); ?></th>
                                            <!--<th>Actions</th>-->
                                        </tr>
                                    </thead>
                                    <tbody class="searchable" id="exampleBody">
                                     <?php $i =1; foreach ($products as $product):
									 if($product['Vary'][0]['sellable_qty'] > 0) { ?>
                                        <tr>
                                            <td><?php echo $i; ?><input type="hidden" value="<?php echo h($product['Product']['vendor_id']); ?>" /></td>
                                            <td><?php  $users = $this->Util->getVendorName($product['Product']['vendor_id']); echo isset($users['Vendor']['name']) ? $users['Vendor']['name'] : '';?></td>
                                            <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                                            <td><?php echo $this->Html->image('product/small/'.$product['Product']['image']);?>&nbsp;</td>
                                            
                                            <td><?php echo h($product['Vary'][0]['po_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['invoice_qty']); ?>&nbsp;</td>
                                            <!--<td>NULL</td>-->
                                            <td><?php echo h($product['Vary'][0]['ship_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['unship_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['inb_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['inb_ship_missing_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['defect_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['inb_missing_qty']); ?></td>
                                            <?php $unsell= ($product['Vary'][0]['sellable_qty']-$product['Vary'][0]['sold_qty']-$product['Vary'][0]['cr_qty']-$product['Vary'][0]['mfg_return_qty']); ?>
                                            <td><?php echo h($unsell > 0 ? $unsell : 0); ?>&nbsp;</td>
                                            
                                            <td><?php echo h($product['Vary'][0]['sold_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['cr_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['mfg_return_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['defect_qty']+$product['Vary'][0]['cr_qty']+$product['Vary'][0]['mfg_return_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Vary'][0]['inb_ship_missing_qty']+$product['Vary'][0]['inb_missing_qty']); ?>&nbsp;</td>
                                           <?php /*?> <td class="actions"><?php echo $this->Html->link(__('View'), array('action' => 'listview', $product['Product']['id'])); ?></td><?php */?>
                                        </tr>
                                        
                                    <?php $i++;} endforeach; ?>
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
	$('.childTr').on('click',function(e){
		var rel =$(this).attr('rel');console.log(rel);
		$('#shows'+rel).show();
	});	
</script>
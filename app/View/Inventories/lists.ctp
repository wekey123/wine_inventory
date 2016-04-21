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
                            <div class="table-responsive" style="overflow-x:hidden;">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->Paginator->sort('vendor'); ?></th>
                                            <th><?php echo $this->Paginator->sort('category'); ?></th>
                                            <th><?php echo $this->Paginator->sort('title'); ?></th>
                                            <th><?php echo $this->Paginator->sort('image'); ?></th>
                                            <th><?php echo $this->Paginator->sort('country'); ?></th>
                                            <th><?php echo $this->Paginator->sort('brand'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Location'); ?></th>
                                            <th><?php echo $this->Paginator->sort('flavor'); ?></th>
                                            <th><?php echo $this->Paginator->sort('label'); ?></th>
                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="searchable" id="exampleBody">
                                     <?php $i =1; foreach ($products as $product): ?>
                                        <tr>
                                            <td><?php echo $i; ?><input type="hidden" value="<?php echo h($product['Product']['vendor_id']); ?>" /></td>
                                            <td><?php  $users = $this->Util->getVendorName($product['Product']['vendor_id']); echo isset($users['Vendor']['name']) ? $users['Vendor']['name'] : '';?></td>
                                            <td><?php  $cat = $this->Util->getVendorType($product['Product']['vendor_type']); echo isset($cat['Category']['name']) ? $cat['Category']['name'] : '';?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                                            <td><?php echo $this->Html->image('product/small/'.$product['Product']['image']);?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['brand']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['country']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['location']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['flavor']); ?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['label']); ?>&nbsp;</td>
                                            <td class="actions">
                                                <?php //echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
                                                <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
                                                <?php /*?><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?><?php */?>
                                                <a class="childTr" rel="<?php echo $i; ?>">Details</a>
                                            </td>
                                        </tr>
                                        <tr id="shows<?php echo $i; ?>" style="display:none">
                                        	<td colspan="11">
                                             <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-warning">
                                                       <strong><?php echo __('Total Order Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['po_qty']); ?></span> <br />
                                                       <strong><?php echo __('Total Invoice Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['invoice_qty']); ?></span> <br />
                                                     <strong><?php echo __('Total Shipped Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['ship_qty']); ?></span> <br />
                                                       <strong><?php echo __('Total Unshipped Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['unship_qty']); ?></span> <br />
                                                       <strong><?php echo __('Total Inbound Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['inb_qty']); ?></span> <br />
                                                       <strong><?php echo __('Total Inbound Missing Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['inb_ship_missing_qty']); ?></span> <br />
                                                       <strong><?php echo __('Total Defect Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['defect_qty']); ?></span> <br />
                                                       <strong><?php echo __('Total Sellable Quantity'); ?></strong> <span> : </span> <span><?php echo h($product['Vary'][0]['sellable_qty']); ?></span> <br />
                                                    </div>
                                                </div>
                                            </div>	                                    
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
<?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->element('tableScript'); ?>
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
        <?php echo $this->Html->link('Add sale Entry', array('action' => 'addproduct/#/salesadd'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Sales List</h4>
 <form method="post" name="searchSort">
         	             <p>From: <input class="datepicker" id="dateFrom" name="dateFrom" type="text" value="<?php echo isset($data) ? $data['dateFrom'] : $this->request->data['dateFrom']?>"> To: <input class="datepicker" name="dateTo" id="dateTo" type="text" value="<?php echo isset($data) ? $data['dateTo'] : $this->request->data['dateTo']?>"><button class="buttApply" style="margin-left:20px;">APPLY</button></p>
           </form>
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
                           <?php echo __('Sales List'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x:hidden;">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                            <th><?php echo $this->Paginator->sort('#'); ?></th>
                                            <th><?php echo $this->Paginator->sort('sale_no'); ?></th>
                                            <th><?php echo $this->Paginator->sort('total_quantity','Sold Qty'); ?></th>
                                            <th><?php echo $this->Paginator->sort('total_price','Sold Price'); ?></th>
                                            <th><?php echo $this->Paginator->sort('created','Sold Date'); ?></th>
                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody class="searchable" id="exampleBody">
                                    <?php $i =1 ; foreach ($sales as $sale):?>
                                    <tr>
                                        <td><?php echo $i; ?>&nbsp;</td>
                                        <td><?php echo $this->Html->link($sale['Sale']['sales_no'], array('controller' => 'sales', 'action' => 'view',$sale['Sale']['sales_no'])); ?> </td>
                                        <td><?php echo h($sale['Sale']['total_quantity']); ?>&nbsp;</td>
                                        <td><?php echo $this->Util->currencyFormat($sale['Sale']['total_price']); ?>&nbsp;</td>
										<td><?php echo $this->Util->dateOnlyFormat($sale['Sale']['sold_date']); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $sale['Sale']['sales_no'])); ?> | 
                                            <?php echo $this->Html->link(__('Edit'), array('action' => 'addproduct/#/salesedit/', $sale['Sale']['sales_no'])); ?> 
                                            <?php /*?><?php echo $this->Html->link(__('Download'), array('action' => 'report',$sale['Sale']['sales_no'])); ?<?php */?>
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
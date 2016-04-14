<?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->element('tableScript'); ?>
<style>
	td.details-control {
    background: url('img/details_open.png') no-repeat center center;
    cursor: pointer;
	}
	tr.shown td.details-control {
		background: url('img/details_close.png') no-repeat center center;
	}
	
	</style>
 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
           <?php echo $this->Html->link('Create PO', array('action' => 'addproduct/#po/'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Purchase Order Lists</h4>
            <div class="form-group">
                <label>Select Vendor</label>
                <select class="form-control" name="filterVendor" id="filterVendor">
                  <option value="" style="width:45%; float:left">Select Vendor</option>
                     <?php foreach($vendor as $key => $vend) {?>
                        <option value="<?php echo h($vend); ?>"  style="width:45%; float:left"><?php echo h($vend); ?></option>
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
      <form method="post" name="searchSort">
           <p>From: <input class="datepicker" id="dateFrom" name="dateFrom" type="text" value="<?php echo isset($data) ? $data['dateFrom'] : ''?>"> To: <input class="datepicker" name="dateTo" id="dateTo" type="text" value="<?php echo isset($data) ? $data['dateTo'] : ''?>"><button class="buttApply" style="margin-left:20px;">APPLY</button></p>
           </form>
      </div>
     </div>
 	<div class="row">	
 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo __('Purchase Orders'); ?>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive" style="overflow-x:hidden;">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                            <th><?php echo $this->Paginator->sort('#'); ?></th>
                                            <th><?php echo $this->Paginator->sort('No'); ?></th>
                                            <th><?php echo $this->Paginator->sort('vendor'); ?></th>
                                            <th><?php echo $this->Paginator->sort('po_no', 'Purchase Order Number'); ?></th>
                                            <th><?php echo $this->Paginator->sort('total_quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('total_price'); ?></th>
                                            <th><?php echo $this->Paginator->sort('user_id', 'Created By'); ?></th>
                                            <th><?php echo $this->Paginator->sort('created'); ?></th>
                                            <th><?php echo $this->Paginator->sort('status'); ?></th>
                                            <?php /*?><th><?php echo $this->Paginator->sort('modified'); ?></th><?php */?>
                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="exampleBody">
                                    <?php $i=1;foreach ($orders as $order): ?>
                                    <tr>
                                          <td class="details-control"><?php 
										  $pos=array();
										foreach($order['Vary'] as $vary){
											if($vary['po_no']==$order['Order']['po_no']){
												$products = $this->Util->getProductdetails($vary['product_id']);
												  $vary['product_title'] = isset($products['Product']['title']) ? $products['Product']['title'] : '';
												$pos[]=$vary;
											}
										}
										
										?>
                                        <input type="hidden" name="" id="Allvary" rel="" value="<?php echo htmlspecialchars(json_encode(($pos))); ?>"  /></td>
                                        <td class="order"><?php echo h($i); ?><input type="hidden" value="<?php echo h($order['Order']['vendor']); ?>" /></td>
                                        <td class="order"><?php echo h($order['Order']['vendor']); ?>&nbsp;
                                        <td class="order"><?php echo h($order['Order']['po_no']); ?>&nbsp;
                                        <?php 
										foreach($order['Vary'] as $vary){
											if($vary['po_no']==$order['Order']['po_no']){
												$products = $this->Util->getProductdetails($vary['product_id']);
												  $vary['product_title'] = isset($products['Product']['title']) ? $products['Product']['title'] : '';
												$pos[]=$vary;
											}
										}
										
										?>
                                        <input type="hidden" name="" id="Allvary" rel="" value="<?php echo htmlspecialchars(json_encode(($pos))); ?>"  />
                                        
                                        <?php unset($pos)?>
                                        </td>
                                        <td><?php echo h($order[0]['total_quantity']); ?>&nbsp;</td>
                                        <td><?php echo $this->Util->currencyFormat($order[0]['total_price'], 'USD');  ?>&nbsp;</td>
                                        <td><?php echo h($order['User']['username']); ?>&nbsp;</td>
                                        <td><?php  echo $this->Util->dateFormat($order['Order']['created']); ?>&nbsp;</td>
                                        <td><?php  echo ($order['Order']['status'] == 0) ? 'Email Not Sent' : (($order['Order']['status'] == 1) ? 'Email Sent' : (($order['Order']['status'] == 2) ? 'Invoice Received' : (($order['Order']['status'] == 3) ? 'Partially Paid' : (($order['Order']['status'] == 4) ? 'Fully Paid' : '' ) ))); ?>&nbsp;</td>
                                        <td class="actions">
                                            <?php if($order['Order']['status'] == 0 || $order['Order']['status'] == 1){
                                              echo $this->Html->link(__('Edit'), array('action' => 'addproduct/#edit/', $order['Order']['po_no'],''));  
                                              echo ' |';}
											?>
                                            <?php echo $this->Html->link(__('Email'), array('action' => 'report',$order['Order']['po_no'],'email')); ?> |
                                            <?php echo $this->Html->link(__('Download'), array('action' => 'report',$order['Order']['po_no'])); ?> 
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

<script>
	/* Formatting function for row details - modify as you need */
function format ( d) {
	console.log(d);
 var toReturn; 
			
     toReturn =  '<table class="table table-hover"><thead><tr><th>#</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>SKU</th><th>Bar Code</th></tr></thead><tbody>';
		$(jQuery.parseJSON(d)).each(function(i) {
			var itemQuantityVal;   
	 		toReturn += '<tr><td>'+parseInt(i+1)+'</td><td>'+this.product_title+' ('+this.variant+this.metric+' '+this.qty+'/'+this.qty_type+') '+'</td><td>'+this.quantity+'</td><td>'+this.price+'</td><td>'+this.sku+'</td><td>'+this.barcode+'</td></tr>';
		});
		toReturn += ' <tr></tr></tbody></table>';
		return toReturn;
}
 
$(document).ready(function() {
  $(function() {
    $('.datepicker').datepicker({
		format: 'yyyy/mm/dd',
		startDate: '-3d'
	});
  });
	
    var table = $('#example').DataTable();
     
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
		var pos=$(this).find('#Allvary').val();
        var tr = $(this).closest('tr');
		console.log(table);
        var row = table.row( tr );
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(pos) ).show();
            tr.addClass('shown');
			tr.next('tr').find("td:first").attr('colspan',10)
        }
		});
	});
	function filterTable(inputVal){
		if(inputVal !=''){console.log(inputVal);
		var table1 = $('#exampleBody');
		table1.find('tr').each(function(index, row){
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
			var table1 = $('#example');
				table1.find('tr').each(function(index, row){$(row).show();
			});
		}
		console.log(table1);
		//paginateTable(table1);
	}
	$('#filterVendor').on('change',function(e){
		filterTable($(this).val());//paginateTable1();
	});	
    </script>
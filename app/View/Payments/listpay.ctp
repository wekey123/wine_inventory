<?php echo $this->Html->css('jquery-ui.css');echo $this->Html->script('jquery-1.10.2');echo $this->Html->script('jquery-ui'); ?>
 <?php echo $this->element('tableScript'); ?>

 <div class="content-wrapper">
   <div class="container">
     <div class="row">
        <div class="col-md-12">
             <?php echo $this->Html->link('Add Payment Entry', array('action' => 'add'),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Payments Vendor List</h4>
            <?php if(!empty($this->request->data['filterVendor'])){ $paramsId = $this->request->data['filterVendor']; }else{ $paramsId = 'ALL'; } ?>
            <div class="form-group">
             <form method="post" name="searchSort">
                <label>Select Vendor</label>
                <select class="form-control" name="filterVendor" id="filterVendor">
                  <option value="ALL" <?php if($paramsId == "ALL"){ echo "selected"; } ?> style="width:45%; float:left">ALL</option>
                     <?php foreach($vendor as $key => $vend) {?>
                      <option value="<?php echo h($key); ?>"  <?php if($paramsId == $key){ echo "selected"; } ?>  style="width:45%; float:left"><?php echo h($vend); ?></option>
                    <?php } ?>
                </select> 
            </div>
            
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
                           <?php echo __('Payments Vendor List'); ?>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive" style="overflow-x:hidden;">
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
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
        <td><?php echo $payment[0]['total_quantity']; //$payment['Payment']['payment_qty']; ?>&nbsp;</td>
		<td><?php echo $this->Util->currencyFormat($payment[0]['total_amount']); 
		$total['invoice_qty']+=$inv_qty;
		$total['order_qty']+=$po_qty;
		$total['qty']+=$payment[0]['total_quantity'];
		$total['amount']+=$payment[0]['total_amount'];
		 ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['invoice_no'])); ?> | 
            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['invoice_no'])); ?>
		</td>
	</tr>
<?php $i++; endforeach; ?>
	<tr id="totalrow"><td colspan="4"></td><td><?php echo  $total['invoice_qty']; ?></td><td><?php echo  $total['order_qty']; ?></td><td><?php echo  $total['qty']; ?></td><td colspan="2"><?php echo  $this->Util->currencyFormat($total['amount']); ?></td></tr>
	</tbody>
	</table>
    						</div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
         </div>
    </div>
    
<script>	
$(document).ready(function() {
	  $(function() {
		$('.datepicker').datepicker({
			format: 'yyyy/mm/dd',
			startDate: '-3d'
		});
	  });
});
</script>
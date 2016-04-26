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
            <th><?php echo $this->Paginator->sort('vendor name','vendor name'); ?></th>
            <th><?php echo $this->Paginator->sort('Invoice Date'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_no','Invoice no'); ?></th>
            <th><?php echo $this->Paginator->sort('Invoice Amount'); ?></th>
            <th><?php echo $this->Paginator->sort('payment_method','Paid Through'); ?></th>
			<th><?php echo $this->Paginator->sort('Payment amount'); ?></th>
            <th><?php echo $this->Paginator->sort('Status'); ?></th>
	</tr>
	</thead>
	 <tbody class="searchable" id="exampleBody">
	<?php 
		$i =1; $total['pay_amount'] = 0; $total['inv_amount'] = 0; 
		foreach ($payments as $payment): 
		$invoiceDetails = $this->Util->getInvoiceDetails($payment['Payment']['invoice_no']);
	?>
	<tr>
		<td><?php echo h($i); ?><input type="hidden" value="<?php echo h($payment['Payment']['vendor_id']); ?>" /> </td>
        <td><?php echo h($this->Util->getVendorNameAlone($payment['Payment']['vendor_id'])); ?>&nbsp;</td>
        <td><?php echo $this->Util->dateOnlyFormat($invoiceDetails['invoice_date']); ?></td>
		<td>
			<?php echo $this->Html->link($payment['Payment']['invoice_no'], array('controller' => 'invoices', 'action' => 'view', $payment['Payment']['invoice_no'])); ?>
		</td>
        <td><?php echo $this->Util->currencyFormat($invoiceDetails['total_price']); ?></td>
        <td><?php echo  $payment['Payment']['payment_method']; ?></td>
		<td><?php echo $this->Util->currencyFormat($payment[0]['total_amount']); 
		$total['inv_amount']+=$invoiceDetails['total_price'];
		$total['pay_amount']+=$payment[0]['total_amount']; ?>&nbsp;</td>
        <td><?php if($invoiceDetails['status'] == 1){ echo "Partially Paid"; }else if($invoiceDetails['status'] == 2){ echo "Fully Paid"; }else{ echo "Fully Paid"; }   ?></td>

	</tr>
<?php $i++; endforeach; ?>
 <tr class="info"><td colspan="4" align="right">Sum of Invoice Amount : </td><td><b><?php echo  $this->Util->currencyFormat($total['inv_amount']); ?></b></td><td align="right">Sum of Payment amount : </td><td><b><?php echo  $this->Util->currencyFormat($total['pay_amount']); ?></b></td><td></td></tr>
	</tbody>
	</table>
    						</div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
         </div>
    </div>
   <!-- <div>
     <table style="background-color:#d9edf7; border:0px; width:100%">
    <tr ><td colspan="4"></td><td><?php echo  $this->Util->currencyFormat($total['inv_amount']); ?></td><td><?php echo  $this->Util->currencyFormat($total['pay_amount']); ?></td><td></td></tr>
    </table>
    </div>-->

<style>
.heading{
	    font-weight: bold;
}
</style>
<div class="content-wrapper">
   <div class="container">
   
 
<div class="row" style="margin-bottom:5%">

           <div class="col-md-12">
               <h4 class="page-head-line">Shipping Details</h4>
           </div>
        
           <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Vendor Name'); ?></div>
                    <div class="col-md-8"><?php $vendor=$this->Util->getVendorName($shipping['Shipping']['vendor_id']); echo h($vendor['Vendor']['name']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Shippment Posted by'); ?></div>
                    <div class="col-md-8"><?php $user=$this->Util->getUserdetails($shipping['Shipping']['user_id']); echo h($user['User']['username']); ?></div>
                </div>
               <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Purchase Order Number'); ?></div>
                    <div class="col-md-8"><?php echo h($shipping['Shipping']['po_no']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Invoice Number'); ?></div>
                    <div class="col-md-8"><?php echo h($test['invoice_no']); ?></div>
                </div>
            </div>
            <div class="col-md-6" style="margin-bottom:35px;"> 
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Shippment Number'); ?></div>
                    <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_no']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Shipping Method'); ?></div>
                    <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_method']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Tracking No'); ?></div>
                    <div class="col-md-8"><?php echo h($shipping['Shipping']['tracking_no']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Received Date'); ?></div>
                    <div class="col-md-8"><?php echo h($shipping['Shipping']['received_date']); ?></div>
                </div>
            </div>
    
        </div>

 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Products List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->Paginator->sort('Product Name'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Invoice Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Shipping Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Inbound Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Defect Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('UnShipping Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('INB Missing Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Sellable Quantity'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $i =1;foreach($shipping['Vary'] as $ship): //debug($ship); ?>
                                        <tr>
                                            <td><?php echo $i; ?>&nbsp;</td>
                                            <td><?php $prod=$this->Util->getProductdetails($ship['product_id']); echo h($prod['Product']['title']); ?>&nbsp;</td>											<td><?php echo h($ship['invoice_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($ship['ship_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($ship['inb_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($ship['defect_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($ship['unship_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($ship['inb_ship_missing_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($ship['sellable_qty']); ?>&nbsp;</td>
                                        </tr>
                                    <?php $i++;endforeach; ?>
                                     	<tr class="info">
                                            <td colspan="2" align="center"><b>Total&nbsp;</b></td>
                                            <td><b><?php echo h($test['invoice_quantity']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($test['ship_qty']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($test['inb_qty']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($test['defect_qty']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($test['unship_qty']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($test['inb_ship_missing_qty']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($test['sellable_qty']); ?>&nbsp;</b></td>
                                        </tr>
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
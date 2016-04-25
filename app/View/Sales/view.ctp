<style>
.heading{
	    font-weight: bold;
}
</style>
<div class="content-wrapper">
   <div class="container">
   
 
<div class="row" style="margin-bottom:5%">

           <div class="col-md-12">
               <h4 class="page-head-line">Sales Details</h4>
           </div>
        
           <div class="col-md-6">
                <?php /*?><div class="row">
                    <div class="col-md-4 heading"><?php echo __('Vendor Name'); ?></div>
                    <div class="col-md-8"><?php $vendor=$this->Util->getVendorName($sale['Sale']['vendor_id']); echo h($vendor['Vendor']['name']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Shippment Posted by'); ?></div>
                    <div class="col-md-8"><?php $user=$this->Util->getUserdetails($sale['Sale']['user_id']); echo h($user['User']['username']); ?></div>
                </div><?php */?>
               <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Sale No'); ?></div>
                    <div class="col-md-8"><?php echo h($sale['Sale']['sales_no']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Total Sold Quantity'); ?></div>
                    <div class="col-md-8"><?php echo h($sale['Sale']['total_quantity']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Total Price'); ?></div>
                    <div class="col-md-8"><?php echo $this->Util->currencyFormat($sale['Sale']['total_price']); ?></div>
                </div>

            </div>
            
            <div class="col-md-6" style="margin-bottom:35px;"> 
               <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Sold Date'); ?></div>
                    <div class="col-md-8"><?php echo $this->Util->dateOnlyFormat($sale['Sale']['sold_date']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Created'); ?></div>
                    <div class="col-md-8"><?php echo $this->Util->dateOnlyFormat($sale['Sale']['created']); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-4 heading"><?php echo __('Modified'); ?></div>
                    <div class="col-md-8"><?php echo $this->Util->dateOnlyFormat($sale['Sale']['modified']); ?></div>
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
                                            <th><?php echo $this->Paginator->sort('Image'); ?></th>
                                             <th><?php echo $this->Paginator->sort('Vendor'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Sold Qty'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Cust return Qty'); ?></th>
                                            <th><?php echo $this->Paginator->sort('MFG return Qty'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $i =1;foreach($sale['Vary'] as $prod): ?>
                                        <tr>
                                            <td><?php echo $i; ?>&nbsp;</td>
                                            <td><?php $prodname=$this->Util->getProductdetails($prod['product_id']);?>
                                             <?php echo h($prodname['Product']['title'].' ('.$prodname['Vary'][0]['variant'].' '.$prodname['Vary'][0]['metric'].' '.$prodname['Vary'][0]['qty'].'/'.$prodname['Vary'][0]['qty_type'].')'); ?>
                                             </td>	
                                            <td><?php echo $this->Html->image('product/small/'.$prodname['Product']['image'],array('style'=>"width: 50px;"));?></td>	
                                            <td><?php echo $this->Util->getVendorNameAlone($prodname['Product']['vendor_id']); ?>&nbsp;</td>															
                                            <td><?php echo h($prod['sold_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($prod['cr_qty']); ?>&nbsp;</td>
                                            <td><?php echo h($prod['mfg_return_qty']); ?>&nbsp;</td>
                                        </tr>
                                    <?php $i++;endforeach; ?>
                                     	<tr class="info">
                                            <td colspan="4" align="center"><b>Total&nbsp;</b></td>
                                            <td><b><?php echo h($prodTotal['sold_qty']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($prodTotal['cr_qty']); ?>&nbsp;</b></td>
                                            <td><b><?php echo h($prodTotal['mfg_return_qty']); ?>&nbsp;</b></td>
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
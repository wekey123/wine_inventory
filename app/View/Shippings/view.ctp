<style>
.heading{
	    font-weight: bold;
}
</style>
<div class="content-wrapper">
   <div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
               <strong><?php echo __('Purchase Order Number'); ?></strong> <span> : </span> <span><?php echo h($test['po_no']); ?></span> <br />
               <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($test['invoice_no']); ?></span> <br />
               <strong><?php echo __('Invoice Quantity'); ?></strong> <span> : </span> <span><?php echo h($test['invoice_quantity']); ?></span> <br />
               <strong><?php echo __('Shipping Quantity'); ?></strong> <span> : </span> <span><?php echo h($test['shipping_quantity']); ?></span> <br />
               <strong><?php echo __('Weight'); ?></strong> <span> : </span> <span><?php  echo h($test['weight']);  ?></span> <br />
            </div>
        </div>
    </div>
 <?php $var=0; foreach($shipping as $shipping) { ?>  
<div class="row" style="margin-bottom:5%">

       <div class="col-md-12">
                   <h4 class="page-head-line">Shipping View (<?php echo h($shipping['Shipping']['shipping_no']); ?>)</h4>
        </div>
        
        <div class="col-md-5">
            <?php  $users = $this->Util->getUserdetails($shipping['Shipping']['user_id']); $uname= isset($users['User']['username']) ? $users['User']['username'] : '';?>
            <div class="row">
            <div class="col-md-4 heading"><?php echo __('User Name'); ?></div>
            <div class="col-md-8"><?php echo h($uname); ?></div>
            </div>
            <div class="row">
            <div class="col-md-4 heading"><?php echo __('Po No'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['po_no']); ?></div>
            </div>
            <div class="row">
            <div class="col-md-4 heading"><?php echo __('Invoice No'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_no']); ?></div>
            </div>
            <div class="row">
            <div class="col-md-4 heading"><?php echo __('Shipping No'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_no']); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('Shipping Quantity'); ?></div>
                <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_quantity']); ?></div>
            </div>
            <?php $var = $var > 0 ? $var+$shipping['Shipping']['shipping_quantity'] : $shipping['Shipping']['shipping_quantity']; ?>
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('UnShipping Quantity'); ?></div>
                <div class="col-md-8"><?php //echo $this->Util->getUnshippedQty($shipping['Shipping']['id']);
				echo $shipping['Shipping']['invoice_quantity']-$var ?></div>
            </div>
        </div>
        <div class="col-md-5">
            
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('Shipping Method'); ?></div>
                <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_method']); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('Tracking No'); ?></div>
                <div class="col-md-8"><?php echo h($shipping['Shipping']['tracking_no']); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('Weight'); ?></div>
                <div class="col-md-8"><?php echo h($shipping['Shipping']['weight']); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('Received Date'); ?></div>
                <div class="col-md-8"><?php echo h($shipping['Shipping']['received_date']); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('Created Date'); ?></div>
                <div class="col-md-8"><?php echo h($shipping['Shipping']['created']); ?></div>
            </div>
            <?php if(isset($shipping['Shipping']['modified'])) { ?>
            <div class="row">
                <div class="col-md-4 heading"><?php echo __('Modified Date'); ?></div>
                <div class="col-md-8"><?php echo h($shipping['Shipping']['modified']); ?></div>
            </div>
            <?php } ?>
        </div>
</div>
<?php } ?>
 </div>
</div>
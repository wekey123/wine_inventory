<style>
.heading{
	    font-weight: bold;
}
</style>
<div class="content-wrapper">
   <div class="container">
   
   
<div class="row">

       <div class="col-md-12">
       <?php echo $this->Html->link('Edit Shipping', array('action' => 'edit', $shipping['Shipping']['id']),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Shipping View</h4>
        </div>
        
        <div class="col-md-10">
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Id'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['id']); ?></div>
        </div>
         <div class="row">
            <div class="col-md-2 heading"><?php echo __('User Id'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['user_id']); ?></div>
        </div>
         <div class="row">
            <div class="col-md-2 heading"><?php echo __('Po No'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['po_no']); ?></div>
        </div>
         <div class="row">
            <div class="col-md-2 heading"><?php echo __('Invoice No'); ?></div>
            <div class="col-md-8"><?php echo $this->Html->link($shipping['Invoice']['id'], array('controller' => 'invoices', 'action' => 'view', $shipping['Invoice']['id'])); ?></div>
        </div>
         <div class="row">
            <div class="col-md-2 heading"><?php echo __('Shipping No'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_no']); ?></div>
        </div>
        
        
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Shipping Quantity'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_quantity']); ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('UnShipping Quantity'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['unshipped_quantity']); ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Shipping Method'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['shipping_method']); ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Tracking No'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['tracking_no']); ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Weight'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['weight']); ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Received Date'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['received_date']); ?></div>
        </div>
         <div class="row">
            <div class="col-md-2 heading"><?php echo __('Created Date'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['created']); ?></div>
        </div>
        <div class="row">
            <div class="col-md-2 heading"><?php echo __('Modified Date'); ?></div>
            <div class="col-md-8"><?php echo h($shipping['Shipping']['modified']); ?></div>
        </div>
        
        </div>
</div>
 </div>
</div>
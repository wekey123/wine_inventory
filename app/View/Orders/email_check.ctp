<style>
.varHead label{
	width:25%;
	margin-bottom:0px;
}
.varHead input[type="text"]{
	width:15%;
	float:left;
	margin-right:10%;
	margin-bottom:0px;
}
</style>
<div class="content-wrapper">
    <div class="container">
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Compose Email'); ?> </h1>
            </div>
        </div>
              <?php //debug($order);?>  
    <div class="row">
        <div class="col-md-5" style="margin-right:10%;">    
	<?php echo $this->Form->create('Order',array('url'=>'/orders/emailCheck/'.$po_no)); ?>
	<?php
		echo $this->Form->input('to',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('subject',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('message',array('div'=>false,'error'=>false,'type'=>'textarea','before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
	?>
    <div id="varient-wrapper"></div>
     <?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>

		<div class="col-md-5">
            <div class="panel panel-default">
                        <div class="panel-heading">
                            Order details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                             <strong><?php echo __('Vendor Name'); ?></strong> <span class="colon"> : </span> <span><?php echo $this->Util->getVendorNameAlone($order['Order']['vendor_id']); ?></span> <br />
                             
                               <strong><?php echo __('PO Number'); ?></strong> <span class="colon"> : </span> <span><?php echo h($order['Order']['po_no']); ?></span> <br />
                              
                               <strong><?php echo __('PO Quantity'); ?></strong> <span class="colon"> : </span> <span id="invoiceqty"><?php echo h($order[0]['total_quantity']); ?></span> <br />
                             
                                <strong><?php echo __('PO Amount'); ?></strong> <span class="colon"> : </span> <span><?php echo $this->Util->currencyFormat($order[0]['total_price']); ?></span> <br />
                              
                              <strong><?php echo __('Created Date'); ?></strong> <span class="colon"> : </span> <span><?php echo $this->Util->DateFormat($order['Order']['created']); ?></span> <br />
                               
                                
                            </div>
                        </div>
                    </div>
        </div>
</div>

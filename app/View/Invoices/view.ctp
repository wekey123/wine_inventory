<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line"><?php echo __('Invoice View'); ?></h4>

                </div>
                <div class="col-md-12">
                 <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h5>
       			 </div>
         </div><?php //echo '<pre>';print_r($invoice); ?>
            <?php //foreach ($invoice as $invoice) {?>
          		  <div class="row">
                        <div class="col-md-12">
                         <div class="col-md-6">
                        
                            <div class="alert alert-warning">
                               <strong><?php echo __('PO Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['po_no']); ?></span> <br />
                               <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['invoice_no']); ?></span> <br />
                               <strong><?php echo __('Total Quantity'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['total_quantity']); ?></span> <br />
                               <strong><?php echo __('Total Price'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($invoice['Invoice']['total_price']);  ?></span> <br />
                               <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php echo h($invoice['User']['username']); ?></span> <br />
                               <strong><?php echo __('Created On'); ?></strong> <span> : </span> <span><?php 

							   echo $this->Util->dateFormat(strtotime($invoice['Invoice']['created'])); 
							   //echo h($invoice['Invoice']['created']); ?></span> <br />
                            </div>
                          </div>
                          
                          <div class="col-md-6">  
                            <div class="alert alert-warning">
                               <strong><?php echo __('Vendor Name'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['vendor_name']); ?></span> <br />
                               <strong><?php echo __('Vendor Address'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['vendor_address']); ?></span> <br />
                           <strong><?php echo __('Shipping Method'); ?></strong> <span> : </span> <span><?php  echo $invoice['Invoice']['shipping_method'];  ?></span> <br />
                               <strong><?php echo __('Payment Terms'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['payment_terms']); ?></span> <br />
                                <strong><?php echo __('Invoice Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->dateOnlyFormat($invoice['Invoice']['invoice_date']); ?></span> <br />
                               <strong><?php echo __('Estimated Shipping Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->dateOnlyFormat($invoice['Invoice']['estimated_shipping_date']); ?></span> <br />
                            </div>
                          </div>
                          
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
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->Paginator->sort('Product Name'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Varient'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Price'); ?></th>
                                            <th><?php echo $this->Paginator->sort('SKU'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Barcode'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Invoice Number'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $i =1;foreach ($invoice['Vary'] as $product): ?>
                                        <tr>
                                            <td><?php echo $i; ?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                                            <td><?php echo h($product['variant']); ?>&nbsp;</td>
                                            <td><?php echo h($product['quantity']); ?>&nbsp;</td>
                                            <td><?php echo $this->Util->currencyFormat($product['price']); ?>&nbsp;</td>
                                            <td><?php echo h($product['sku']); ?>&nbsp;</td>
                                            <td><?php echo h($product['barcode']); ?>&nbsp;</td>
                                            <td><?php echo h($product['po_no']); ?>&nbsp;</td>
                                        </tr>
                                    <?php $i++;endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
    </div>
                    
                    
                    
            <?php //} ?>
        </div>
    </div>
 
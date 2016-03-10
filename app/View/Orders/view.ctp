<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line"><?php echo __('Order View'); ?></h4>

                </div>
                <div class="col-md-12">
                 <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h5>
       			 </div>
         </div><?php //echo '<pre>';print_r($order); ?>
            <?php //foreach ($order as $order) {?>
          		  <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                               <strong><?php echo __('Order Number'); ?></strong> <span> : </span> <span><?php echo h($order['Order']['po_no']); ?></span> <br />
                               <strong><?php echo __('Total Quantity'); ?></strong> <span> : </span> <span><?php echo h($order[0]['total_quantity']); ?></span> <br />
                               <strong><?php echo __('Total Price'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($order[0]['total_price']);  ?></span> <br />
                               <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php echo h($order['User']['username']); ?></span> <br />
                               <strong><?php echo __('Created On'); ?></strong> <span> : </span> <span><?php 

							   echo $this->Util->dateFormat(strtotime($order['Order']['created'])); 
							   //echo h($order['Order']['created']); ?></span> <br />
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
                                            <th><?php echo $this->Paginator->sort('Order Number'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $i =1;foreach ($order['Vary'] as $product): ?>
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
 
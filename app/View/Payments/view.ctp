<div class="content-wrapper">

        <div class="container">
            <div class="row">
                  <div class="col-md-12">
                  <?php echo $this->Html->link('Edit Payment', array('action' => 'edit',$invoice['Invoice']['invoice_no']),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
                    <h4 class="page-head-line"><?php echo __('Payment View'); ?></h4>
                  </div>
                  <?php if(!empty($this->Flash->render())){ ?>
              	  <div class="col-md-12">
               		 <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h5>
       			  </div>
                  <?php } ?>
                  <div class="col-md-12" style="color:#000000; text-align:center; font-size:20px;">
                       			Invoice Details
                  </div>
            </div><br/>
		           <?php  
				   		  $totalAmountPayed = array();
						  $paymentqty = array();
				          $this->Util->setInvoiceTotalPrice($invoice['Invoice']['total_price']);
						  $this->Util->setInvoiceTotalQty($invoice['Invoice']['total_quantity']);
				   		  foreach ($invoice['Payment'] as $Payment):
					      $totalAmountPayed[] = $Payment['payment_amount'];
						  $paymentqty[] = $Payment['payment_qty'];
					      endforeach; 
					      $TotalAmountPayed = array_sum($totalAmountPayed);
					      $this->Util->setTotalAmountPayed($TotalAmountPayed);
						  
						  $paymentqty = array_sum($paymentqty);
						  $this->Util->setPayedQty($paymentqty);	  
					?>
          		  <div class="row">
                        <div class="col-md-12">
                         <div class="col-md-6">
                            <div class="alert alert-warning">
                               <strong><?php echo __('PO Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['po_no']); ?></span> <br />
                               <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['invoice_no']); ?></span> <br />
                               <strong><?php echo __('Total Quantity'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['total_quantity']); ?></span> <br />
                               <strong><?php echo __('Quantity Left'); ?></strong> <span> : </span> <span><?php echo $this->Util->getQtyLeft(); ?></span> <br />
                               
                               <strong><?php echo __('Total Amount'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($invoice['Invoice']['total_price']);  ?></span> <br />
                               <strong><?php echo __('Amount Due'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($this->Util->getAmountDue());  ?></span> <br />
                               <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php echo h($invoice['User']['username']); ?></span> <br />
                            
                            </div>
                          </div>
                          
                          <div class="col-md-6">  
                            <div class="alert alert-warning">
                                  <strong><?php echo __('Created On'); ?></strong> <span> : </span> <span><?php
							   echo $this->Util->dateFormat(strtotime($invoice['Invoice']['created'])); 
							   //echo h($invoice['Invoice']['created']); ?></span> <br />
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
                    
                    <?php /*?><div class="row">	
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
                                     <?php $i = 1; foreach ($invoice['Vary'] as $product): ?>
                                        <tr>
                                            <td><?php echo $i; ?>&nbsp;</td>
                                            <td><?php $products = $this->Util->getProductdetails($product['product_id']);  echo isset($products['Product']['title']) ? $products['Product']['title'] : ''; ?>&nbsp;</td>
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
    </div><?php */?>
                    
             <div class="row">	
                     <div class="col-md-12" style="color:#000000; text-align:center; font-size:20px;">
                       			Payment History
                    </div>
            </div>
            <br/>
     <div class="row">	
 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Payment Release
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->Paginator->sort('po_no','P.O.No'); ?></th>
                                            <th><?php echo $this->Paginator->sort('invoice_no'); ?></th>
                                            <th><?php echo $this->Paginator->sort('payment_no'); ?></th>
                                            <th><?php echo $this->Paginator->sort('payment_quantity'); ?></th>
											<th><?php echo $this->Paginator->sort('payment_amount'); ?></th>
                                            <th><?php echo $this->Paginator->sort('payment_date'); ?></th>
                                            <th><?php echo $this->Paginator->sort('payment_method'); ?></th>
                                            <th><?php echo $this->Paginator->sort('user_id','Created By'); ?></th>
                                            <th><?php echo $this->Paginator->sort('created'); ?></th>
                                            <th><?php echo $this->Paginator->sort('modified'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $j = 1; foreach ($invoice['Payment'] as $Payment): ?>
                                        <tr>
                                            <td><?php echo h($j); ?></td>
                                            <td>
												<?php echo $this->Html->link($Payment['po_no'], array('controller' => 'orders', 'action' => 'view', $Payment['po_no'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Html->link($Payment['invoice_no'], array('controller' => 'invoices', 'action' => 'view', $Payment['invoice_no'])); ?>
                                            </td>
                                            <td><?php echo $Payment['payment_no']; ?>&nbsp;</td>
                                            <td><?php echo $Payment['payment_qty']; ?>&nbsp;</td>
                                            <td><?php echo $this->Util->currencyFormat($Payment['payment_amount']); ?>&nbsp;</td>
                                            <td><?php echo $this->Util->dateOnlyFormat($Payment['payment_date']); ?>&nbsp;</td>
                                            <td><?php echo h($Payment['payment_method']); ?>&nbsp;</td>
                                            <td><?php $users = $this->Util->getUserdetails($Payment['user_id']);  echo isset($users['User']['username']) ? $users['User']['username'] : ''; ?>&nbsp;</td>
                                            <td><?php echo $this->Util->dateOnlyFormat($Payment['created']); ?>&nbsp;</td>
                                            <td><?php echo $this->Util->dateOnlyFormat($Payment['modified']); ?>&nbsp;</td>
                                        </tr>
                                    <?php $j++;endforeach; ?>
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
 
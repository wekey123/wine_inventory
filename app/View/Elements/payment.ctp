					<?php  
				          $this->Util->setInvoiceTotalPrice($invoice['Invoice']['total_price']);
				   		  foreach ($invoice['Payment'] as $Payment):
					      $totalAmountPayed[] = $Payment['payment_amount'];
					      endforeach; 
					      $TotalAmountPayed = array_sum($totalAmountPayed);
					      $this->Util->setTotalAmountPayed($TotalAmountPayed);
					?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Invoice details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <?php //echo '<pre>'; print_r($invoice);?>
                               
                                <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['invoice_no']); ?></span> <br />
                               <strong><?php echo __('Invoice Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateOnlyFormat($invoice['Invoice']['invoice_date']); ?></span> <br /> 
                               <strong><?php echo __('Total Product'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['total_quantity']); ?></span> <br />
                                <strong><?php echo __('Total Amount'); ?></strong> <span> : </span> <span><?php echo $this->Util->currencyFormat($invoice['Invoice']['total_price']); ?></span> <br />
                                <strong><?php echo __('Amount Due'); ?></strong> <span> : </span> <span><?php  echo $this->Util->currencyFormat($this->Util->getAmountDue());  ?></span> <br />
                               <strong><?php echo __('Vendor Name'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['vendor_name']); ?></span> <br />
                               <strong><?php echo __('Shipping By'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['shipping_method']); ?></span> <br />
                              <strong><?php echo __('Created Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateFormat($invoice['Invoice']['created']); ?></span> <br />
                               
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Invoice Releases
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <?php $i =1; foreach($invoice['Payment'] as $pay){ ?>
                               <b style="text-decoration:underline;">Release # <?php echo $i;?></b><br />
                               
                                <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($pay['invoice_no']); ?></span> <br />
                               <strong><?php echo __('Payment Number'); ?></strong> <span> : </span> <span><?php echo h($pay['payment_no']); ?></span> <br /> 
                             <strong><?php echo __('Payed Amount'); ?></strong> <span> : </span> <span><?php echo $this->Util->currencyFormat($pay['payment_amount']); ?></span> <br />
                               <strong><?php echo __('Payment Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateOnlyFormat($pay['payment_date']); ?></span> <br />
                               <strong><?php echo __('Payment Method'); ?></strong> <span> : </span> <span><?php echo h($pay['payment_method']); ?></span> <br />
                              <strong><?php echo __('Created Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateFormat($pay['created']); ?></span> <br />
                               <?php $i++;} ?>
                                
                            </div>
                        </div>
                    </div>
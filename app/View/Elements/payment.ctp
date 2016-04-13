<style>
.table-responsive strong {
    width: 30%;
    float: left;
}
.table-responsive span.colon {
    width: 5%;
    float: left;
}
</style>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Invoice details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                             <strong><?php echo __('Vendor Name'); ?></strong> <span class="colon"> : </span> <span><?php echo h($invoice['Invoice']['vendor_name']); ?></span> <br />
                               <?php 
								   echo $this->Form->input('Payment.po_no',array('div'=>false,'error'=>false,'type'=>'hidden', 'value' => $invoice['Invoice']['po_no']));
							   ?>
                               <strong><?php echo __('PO Number'); ?></strong> <span class="colon"> : </span> <span><?php echo h($invoice['Invoice']['po_no']); ?></span> <br />
                                <strong><?php echo __('Invoice Number'); ?></strong> <span class="colon"> : </span> <span><?php echo h($invoice['Invoice']['invoice_no']); ?></span> <br />
                               <strong><?php echo __('Invoice Date'); ?></strong> <span class="colon"> : </span> <span><?php echo $this->Util->DateOnlyFormat($invoice['Invoice']['invoice_date']); ?></span> <br /> 
                               <strong><?php echo __('Total Quantity'); ?></strong> <span class="colon"> : </span> <span id="invoiceqty"><?php echo h($invoice['Invoice']['total_quantity']); ?></span> <br />
                               <strong><?php echo __('Quantity Left'); ?></strong> <span class="colon"> : </span> <span id="invoiceqty"><?php echo $this->Util->getQtyLeft(); ?></span> <br />
                                <strong><?php echo __('Total Amount'); ?></strong> <span class="colon"> : </span> <span><?php echo $this->Util->currencyFormat($invoice['Invoice']['total_price']); ?></span> <br />
                                <?php $due= $this->Util->getAmountDue();?>
                                <strong><?php echo __('Amount Due'); ?></strong> <span class="colon"> : </span> <span><?php  echo $this->Util->currencyFormat($due);  ?></span> <br />
                              
                               <?php /*?><strong><?php echo __('Shipping By'); ?></strong> <span> : </span> <span><?php echo h($invoice['Invoice']['shipping_method']); ?></span> <br /><?php */?>
                              <strong><?php echo __('Created Date'); ?></strong> <span class="colon"> : </span> <span><?php echo $this->Util->DateFormat($invoice['Invoice']['created']); ?></span> <br />
                               
                                
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="dueAmount" value="<?php echo $due;?>" id="myDueamt"  />
                    <input type="hidden" name="totalAmount" value="<?php echo $invoice['Invoice']['total_price'];?>"  />
                    <?php if(!empty($invoice['Payment'])){ ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Payment History
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <?php 
								   $i =1; 
								   $totalpricehistory = array();
									$totalqtyhistory = array();
								   foreach($invoice['Payment'] as $pay){ ?>
								   <b style="text-decoration:underline;">Payment Release # <?php echo $i;?></b><br />
								   
								   <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($pay['invoice_no']); ?></span> <br />
								   <strong><?php echo __('Payment Number'); ?></strong> <span> : </span> <span><?php echo h($pay['payment_no']); ?></span> <br /> 
								   <strong><?php echo __('Payed Quantity'); ?></strong> <span> : </span> <span><?php echo $pay['payment_qty']; ?></span> <br />
								   <strong><?php echo __('Payed Amount'); ?></strong> <span> : </span> <span><?php echo $this->Util->currencyFormat($pay['payment_amount']); ?></span> <br />
								   <strong><?php echo __('Payment Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateOnlyFormat($pay['payment_date']); ?></span> <br />
								   <strong><?php echo __('Payment Method'); ?></strong> <span> : </span> <span><?php echo h($pay['payment_method']); ?></span> <br />
								   <strong><?php echo __('Created Date'); ?></strong> <span> : </span> <span><?php echo $this->Util->DateFormat($pay['created']); ?></span> <br />
								   <?php 
									   $totalpricehistory[] += $pay['payment_amount'];
									   $totalqtyhistory[] += $pay['payment_qty'];
									   $i++;
								   } 
							 	  ?>
                              <input type="hidden" id="totalpricehistory" value='<?php echo $invoice['Invoice']['total_price'] - array_sum($totalpricehistory); ?>'/>
                              <input type="hidden" id="totalqtyhistory" value='<?php echo $invoice['Invoice']['total_quantity'] - array_sum($totalqtyhistory); ?>'/>
                              
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                  <input type="hidden" id="totalpricehistory" value='<?php echo $invoice['Invoice']['total_price']; ?>' />
                  <input type="hidden" id="totalqtyhistory" value='<?php echo $invoice['Invoice']['total_quantity']; ?>' />
                  <?php  } ?>
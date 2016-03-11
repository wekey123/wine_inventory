<?php echo $this->element('tableScript'); ?>
<div class="row">	
 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Products List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x:hidden;">
                                <table id="invoice_tab" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->Paginator->sort('Product Name'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Varient'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Order Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Invoice Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Price'); ?></th>
                                            <th><?php echo $this->Paginator->sort('SKU'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Barcode'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Order Number'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceSaveID">
                                     <?php $i =1;foreach ($order['Vary'] as $product): ?>
                                        <tr>
                                            <td><?php echo $i; ?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                                            <td><?php echo h($product['variant']); ?>&nbsp;</td>
                                            <td><?php echo h($product['quantity']); ?>&nbsp;</td>
                                            <td><input type="text" value="" name="Vary[quantity][<?php echo $i; ?>]"  />
                                      <input type="hidden" name="Vary[price][<?php echo $i; ?>]" value="<?php echo h($product['price']); ?>" id="itemPrice" />
                                       <input type="hidden" name="Vary[variant][<?php echo $i; ?>]" value="<?php echo h($product['variant']); ?>"  />
                                       <input type="hidden" name="Vary[sku][<?php echo $i; ?>]" value="<?php echo h($product['sku']); ?>"   id="itemSKU" />
                                       <input type="hidden" name="Vary[barcode][<?php echo $i; ?>]" value="<?php echo h($product['barcode']); ?>" />
                                      
                                        <input type="hidden" name="Vary[product_id][<?php echo $i; ?>]" value="<?php echo h($product['product_id']); ?>"  />
                                            </td>
                                            <td><?php echo $this->Util->currencyFormat($product['price']); ?>&nbsp;</td>
                                            <td><?php echo h($product['sku']); ?>&nbsp;</td>
                                            <td><?php echo h($product['barcode']); ?>&nbsp;</td>
                                            <td><?php echo h($product['po_no']); ?>&nbsp;</td>
                                        </tr>
                                    <?php $i++;endforeach; ?>
                                     <input type="hidden" name="Vary[type]" value="invoice"   id="itemVariant" />
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
    </div>
    <script>
    $(document).ready(function() {
		$('#invoice_tab').DataTable();
	} );
    </script>
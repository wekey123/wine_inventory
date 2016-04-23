<?php echo $this->element('tableScript'); ?>
<div class="row">	
 	 <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <label style="color:#a94442;">PO Products List </label>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x:hidden;"><span class="error_msg_var"></span>
                                <table id="invoice_tab1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo $this->Paginator->sort('Product Name'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Varient'); ?></th>
                                            <th><?php echo $this->Paginator->sort('PO QTY'); ?></th>
                                            <th><?php echo $this->Paginator->sort('PO price'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Invoice Quantity'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Price'); ?></th>
                                            <th><?php echo $this->Paginator->sort('SKU'); ?></th>
                                            <th><?php echo $this->Paginator->sort('Barcode'); ?></th>
                                            <th><?php //echo $this->Paginator->sort('Order Number'); ?><input type="checkbox" name="" class="all"  /></th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceSaveID">
                                     <?php $i =1;$j =1;foreach ($order['Vary'] as $product):
									 if($product['type'] =='order' && $product['quantity'] > 0){ ?>
                                        <tr>
                                            <td><?php echo $i; ?>&nbsp;</td>
                                            <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                                            <td><?php echo h($product['variant']); ?>&nbsp;</td>
                                            <td><?php echo h($product['quantity']); ?>&nbsp;</td>
                                            <td><?php echo $this->Util->currencyFormat($product['price']); ?>&nbsp;</td>
                                            <td>
                                            <input type="text" value="<?php echo isset($product['inv_count']) ? $product['inv_count'] : '';?>" name="Vary[quantity][<?php echo $i; ?>]" class="invoiceQuantitychk invquan"  />
                                            <?php if(isset($product['inv_count'])) { ?>
                                            <input type="hidden" name="Vary[quantity_old][<?php echo $i; ?>]" value="<?php echo h($product['inv_count']); ?>"  />
                                            <?php } ?>
                                      <?php /*?><input type="hidden" name="Vary[price][<?php echo $i; ?>]" value="<?php echo h($product['price']); ?>" id="itemPrice" /><?php */?>
                                       <input type="hidden" name="Vary[variant][<?php echo $i; ?>]" value="<?php echo h($product['variant']); ?>"  />
                                       <input type="hidden" name="Vary[sku][<?php echo $i; ?>]" value="<?php echo h($product['sku']); ?>"   id="itemSKU" />
                                       <input type="hidden" name="Vary[barcode][<?php echo $i; ?>]" value="<?php echo h($product['barcode']); ?>" />
                                        <input type="hidden" name="Vary[var_id][<?php echo $i; ?>]" value="<?php echo h($product['id']); ?>" />
                                        <input type="hidden" name="Vary[metric][<?php echo $i; ?>]" value="<?php echo h($product['metric']); ?>" />
                                        <input type="hidden" name="Vary[qty_type][<?php echo $i; ?>]" value="<?php echo h($product['qty_type']); ?>" />
                                        <input type="hidden" name="Vary[qty][<?php echo $i; ?>]" value="<?php echo h($product['qty']); ?>" />
                                        <input type="hidden" name="Vary[vendor_id][<?php echo $i; ?>]" value="<?php echo h($product['vendor_id']); ?>" />
                                        <input type="hidden" name="Vary[category_id][<?php echo $i; ?>]" value="<?php echo h($product['category_id']); ?>" />
                                        <input type="hidden" name="Vary[ord_var_id][<?php echo $i; ?>]" value="<?php echo h($product['var_id']); ?>" />
                                        
                                      
                                        <input type="hidden" name="Vary[product_id][<?php echo $i; ?>]" value="<?php echo h($product['product_id']); ?>"  />
                                        <?php if(isset($product['inv_id'])) { ?>
                                        <input type="hidden" name="Vary[inv_id][<?php echo $i; ?>]" value="<?php echo h($product['inv_id']); ?>"  />
                                        <?php } ?>
                                            </td>
                                           <?php /*?> <td><?php echo $this->Util->currencyFormat($product['price']); ?>&nbsp;</td><?php */?>
                                           <td><input type="text" value="<?php echo isset($product['inv_price']) ? $product['inv_price'] : '';?>" name="Vary[price][<?php echo $i; ?>]" class="invoicePricechk invprice"  /></td>
                                            <td><?php echo h($product['sku']); ?>&nbsp;</td>
                                            <td><?php echo h($product['barcode']); ?>&nbsp;</td>
                                            <td><?php //echo h($product['po_no']); ?> <input type="checkbox" <?php echo isset($product['inv_count']) ? ($product['inv_count'] == $product['quantity'] ? 'checked="checked"' : '') : '';?> rel="<?php echo $product['quantity'];?>"  rel2="<?php echo $product['price'];?>" name="" id="<?php echo $i ?>" class="varchk"  />&nbsp;
                                            </td>
                                        </tr>
                                    <?php $i++; ?> <input type="hidden" class="Allchk" value="<?php echo isset($product['inv_count']) ? ($product['inv_count'] == $product['quantity'] ? $j++ : $j--) : $j--;?>" rel="<?php echo $j == $i ? true : false; ?>" rel2="<?php echo $j; ?>"  rel3="<?php echo $i; ?>"/><?php } endforeach; ?>
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
		console.log($('.Allchk').attr("rel"));
		if($('.Allchk').attr("rel"))
		$('.all').prop("checked", $('.Allchk').attr("rel"));
	} );

$(document).ready(function(){
		$(".all").on("change",function () {//alert('');
			if($(this).is(":checked")){console.log('a');
				$(".varchk").prop("checked", true);
					$('input[type=checkbox]').each(function () {
						$(this).parent().parent().find('.invoiceQuantitychk').val($(this).attr('rel'));
						$(this).parent().parent().find('.invprice').val($(this).attr('rel2'));
					});
			}else{console.log('b');
				$(".varchk").prop("checked", false);
				$('input[type=checkbox]').each(function () {
						$(this).parent().parent().find('.invoiceQuantitychk').val('');
						$(this).parent().parent().find('.invprice').val('');
				});
			}
		});
		
		$(".varchk").on("change",function () {
		//alert("You have checked  "+$(".td:checked").length+"  boxes");
		if($(".varchk").length == $(".varchk:checked").length) {
			$(".all").prop("checked", true);
		} else {
			$(".all").prop("checked", false);
		}
		if($(this).is(":checked")){
		$(this).parent().parent().find('.invoiceQuantitychk').val($(this).attr('rel'));
		$(this).parent().parent().find('.invprice').val($(this).attr('rel2'));
		}
		else{
		$(this).parent().parent().find('.invoiceQuantitychk').val('');
		$(this).parent().parent().find('.invprice').val('');
		}
		});
});
	
    </script>
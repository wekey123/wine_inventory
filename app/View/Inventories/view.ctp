<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line"><?php echo __('Order View'); ?></h4>

                </div>
                <div class="col-md-12">
                 <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h5>
       			 </div>
         </div><?php //echo '<pre>';print_r($inventory); ?>
            <?php //foreach ($inventory as $inventory) {?>
          		  <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                               <strong><?php echo __('Order Number'); ?></strong> <span> : </span> <span><?php echo h($inventory['Order'][0]['po_no']); ?></span> <br />
                               <strong><?php echo __('Total Quantity'); ?></strong> <span> : </span> <span><?php echo h($inventory['Order'][0][0]['total_quantity']); ?></span> <br />
                               <strong><?php echo __('Total Price'); ?></strong> <span> : </span> <span><?php echo h($inventory['Order'][0][0]['total_price']); ?></span> <br />
                               <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php echo h($inventory['User']['username']); ?></span> <br />
                               <strong><?php echo __('Created On'); ?></strong> <span> : </span> <span><?php echo h($inventory['Order'][0][0]['created']); ?></span> <br />
                            </div>
                        </div>
            		</div>
                    
                    
                    <div class="row">
                    <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Inventory Process
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#home-pills" data-toggle="tab">Order</a>
                                </li>
                                <li class=""><a href="#profile-pills" data-toggle="tab">Invoice</a>
                                </li>
                                <li class=""><a href="#messages-pills" data-toggle="tab">Inventory</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home-pills">
                                    <h4></h4>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Order List
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
                                                     <?php $i =1;foreach ($inventory['Vary'] as $product): if($product['type']=='order'){ ?>
                                                        <tr>
                                                            <td><?php echo $i; ?>&nbsp;</td>
                                                            <td><?php //echo h($product['Product']['title']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['variant']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['quantity']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['price']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['sku']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['barcode']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['po_no']); ?>&nbsp;</td>
                                                        </tr>
                                                    <?php $i++;}endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-pills">
                                    <h4></h4>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Invoice List
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
                                                     <?php $i =1;foreach ($inventory['Vary'] as $product):  if($product['type']=='invoice'){  ?>
                                                        <tr>
                                                            <td><?php echo $i; ?>&nbsp;</td>
                                                            <td><?php //echo h($product['Product']['title']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['variant']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['quantity']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['price']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['sku']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['barcode']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['po_no']); ?>&nbsp;</td>
                                                        </tr>
                                                    <?php $i++; } endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="messages-pills">
                                    <h4></h4>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Inventory List
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
                                                     <?php $i =1;foreach ($inventory['Vary'] as $product):  if($product['type']=='inventory'){  ?>
                                                        <tr>
                                                            <td><?php echo $i; ?>&nbsp;</td>
                                                            <td><?php //echo h($product['Product']['title']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['variant']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['quantity']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['price']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['sku']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['barcode']); ?>&nbsp;</td>
                                                            <td><?php echo h($product['po_no']); ?>&nbsp;</td>
                                                        </tr>
                                                    <?php $i++; } endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                	</div>
                    
                    
                    <div class="row">
                    <?php $r = 1; foreach ($inventory['Payment'] as $inventorys) {?>
                    <div class="col-md-4 col-sm-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Release 1
                        </div>
                        <div class="panel-body">
                            <strong><?php echo __('Invoice Number'); ?></strong> <span> : </span> <span><?php echo h($inventorys['invoice_no']); ?></span> <br />
                            <strong><?php echo __('Payment Number'); ?></strong> <span> : </span> <span><?php echo h($inventorys['payment_no']); ?></span> <br />
                            <strong><?php echo __('Payment Amount'); ?></strong> <span> : </span> <span><?php echo h($inventorys['payment_amount']); ?></span> <br />
                            <strong><?php echo __('Payment Date'); ?></strong> <span> : </span> <span><?php echo h($inventorys['payment_date']); ?></span> <br />
                            <strong><?php echo __('Payment Method'); ?></strong> <span> : </span> <span><?php echo h($inventorys['payment_method']); ?></span> <br />
                            <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php echo h($inventory['User']['username']); ?></span> <br />
                            <strong><?php echo __('Created On'); ?></strong> <span> : </span> <span><?php echo h($inventorys['created']); ?></span> <br />
                        </div>
                       
                    </div>
                </div>
                    
                    
                    
                        
                    <?php $r++;} ?>
            		</div>
                    
            </div>
                    
                    
                    
            <?php //} ?>
        </div>
    </div>
 
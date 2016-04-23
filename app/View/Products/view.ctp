<style>
.heading{
	    font-weight: bold;
}
</style>
<div class="content-wrapper">
   <div class="container">
   
   
<div class="row">

       <div class="col-md-12">
       <?php echo $this->Html->link('Edit Product', array('action' => 'edit', $product['Product']['id']),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
            <h4 class="page-head-line">Product View</h4>
        </div>
        
        <div class="col-md-10">
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Id'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['id']); ?></div>
        </div>
         <div class="row">
            <div class="col-md-4 heading"><?php echo __('Vendor'); ?></div>
            <div class="col-md-6"><?php  $users = $this->Util->getVendorName($product['Product']['vendor_id']); echo isset($users['Vendor']['name']) ? $users['Vendor']['name'] : '';?></div>
        </div>
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Category Name'); ?></div>
            <div class="col-md-6 "><?php  $cat = $this->Util->getVendorType($product['Product']['vendor_type']); echo isset($cat['Category']['name']) ? $cat['Category']['name'] : '';?></div>
        </div>
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Created By'); ?></div>
            <div class="col-md-6"><?php echo h($product['User']['username']); ?></div>
        </div>
        
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Title'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['title']); ?></div>
        </div>

		<div class="row">
            <div class="col-md-4 heading"><?php echo __('Description'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['description']); ?></div>
        </div>
		
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Brand'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['brand']); ?></div>
        </div>
		
       
        
		<div class="row">
            <div class="col-md-4 heading"><?php echo __('Country'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['country']); ?></div>
        </div>
        
		<div class="row">
            <div class="col-md-4 heading"><?php echo __('Location'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['location']); ?></div>
        </div>
        
		<?php /*?><div class="row">
            <div class="col-md-4 heading"><?php echo __('Flavor'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['flavor']); ?></div>
        </div>
		
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Label'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['label']); ?></div>
        </div><?php */?>
		
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Image'); ?></div>
            <div class="col-md-6"><?php echo $this->Html->image('product/small/'.$product['Product']['image']);?></div>
        </div>
		
        <?php /*?> <div class="row">
            <div class="col-md-4 heading"><?php echo __('Status'); ?></div>
            <div class="col-md-6"><?php echo h($product['Product']['status']); ?></div>
        </div><?php */?>
		
        <div class="row">
            <div class="col-md-4 heading"><?php echo __('Created'); ?></div>
            <div class="col-md-6"><?php echo $this->Util->dateFormat($product['Product']['created']); ?></div>
        </div>
        
		<div class="row">
            <div class="col-md-4 heading"><?php echo __('Modified'); ?></div>
            <div class="col-md-6"><?php echo $this->Util->dateFormat($product['Product']['modified']); ?></div>
        </div>
      </div>
     </div>
     
     
     
     
     
     
 <div class="row">	
 <div class="col-md-12">
         <!--    Hover Rows  -->
         <div class="panel panel-default">
            <div class="panel-heading">
                Related Varients
            </div>
            <div class="panel-body">
            <div class="table-responsive">
	<?php if (!empty($product['Vary'])): ?>
	 <table class="table table-hover">
	<tr>
		<th><?php echo __('#'); ?></th>
		<th><?php echo __('Weight'); ?></th>
        <th><?php echo __('Quantity/case'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Barcode'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<?php /*?><th class="actions"><?php echo __('Actions'); ?></th><?php */?>
	</tr>
	<?php foreach ($product['Vary'] as $vary): ?>
		<tr>
			<td><?php echo $vary['id']; ?></td>
            <td><?php echo $vary['variant'].$vary['metric']; ?></td>
            <td><?php echo $vary['qty'].$vary['qty_type']; ?></td>
			<td><?php echo $vary['sku']; ?></td>
			<td><?php echo $vary['barcode']; ?></td>
			<td><?php echo $this->Util->currencyFormat($vary['price']);  ?></td>
			<td><?php echo $vary['type']; ?></td>
			<td><?php echo $this->Util->dateFormat($vary['created']); ?></td>
			<td><?php echo $this->Util->dateFormat($vary['modified']); ?></td>
			<?php /*?><td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'varies', 'action' => 'view', $vary['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'varies', 'action' => 'edit', $vary['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'varies', 'action' => 'delete', $vary['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vary['id']))); ?>
			</td><?php */?>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
             </div>
            </div>
           </div>
           <!-- End  Hover Rows  -->
    </div>
</div>

     
  </div>
</div>
<?php /*?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
	</ul>
</div><?php */?>
<?php /*?><div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($product['Order'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Po No'); ?></th>
		<th><?php echo __('Total Quantity'); ?></th>
		<th><?php echo __('Total Price'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['Order'] as $order): ?>
		<tr>
			<td><?php echo $order['id']; ?></td>
			<td><?php echo $order['user_id']; ?></td>
			<td><?php echo $order['product_id']; ?></td>
			<td><?php echo $order['po_no']; ?></td>
			<td><?php echo $order['total_quantity']; ?></td>
			<td><?php echo $order['total_price']; ?></td>
			<td><?php echo $order['created']; ?></td>
			<td><?php echo $order['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div><?php */?>
<?php /*?><div class="related">
	<h3><?php echo __('Related Varies'); ?></h3>
	<?php if (!empty($product['Vary'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Variant'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Barcode'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($product['Vary'] as $vary): ?>
		<tr>
			<td><?php echo $vary['id']; ?></td>
			<td><?php echo $vary['product_id']; ?></td>
			<td><?php echo $vary['variant']; ?></td>
			<td><?php echo $vary['sku']; ?></td>
			<td><?php echo $vary['barcode']; ?></td>
			<td><?php echo $vary['price']; ?></td>
			<td><?php echo $vary['type']; ?></td>
			<td><?php echo $vary['created']; ?></td>
			<td><?php echo $vary['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'varies', 'action' => 'view', $vary['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'varies', 'action' => 'edit', $vary['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'varies', 'action' => 'delete', $vary['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vary['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div><?php */?>
</div>
</div>
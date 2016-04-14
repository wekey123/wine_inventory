<?php
	$menus=array('Dashboard'=>array('dashboard'),'Product'=>array('products'),'User'=>array('users'),'Order'=>array('orders'),'Invoice'=>array('invoices'),'Payment'=>array('payments'),'Shipping'=>array('shippings'),'Inventory'=>array('inventories'),'Vendor'=>array('vendors'));
	function getPageName($name, $array){
		foreach($array as $key => $value){
			if(is_array($value) && in_array($name, $value))
				  return $key;
		}
		return 'Dashboard';
	}
	$name=explode('/', $_SERVER['REQUEST_URI']);
    if($_SERVER['HTTP_HOST'] == '52.4.188.247')
	$name=$name[2];
	else
	$name=$name[1];
	$menuActive = $_SERVER['REQUEST_URI'] != '/' ? getPageName($name, $menus) : 'Dashboard';
 ?>
	
	
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li> <?php echo $this->Html->link('Dashboard',array('controller'=>'dashboard','action' => 'index'),array('class'=>trim($menuActive)=='Dashboard'  ? 'menu-top-active' : '')); ?> </li>
                            <li> <?php echo $this->Html->link('User',array('controller'=>'users','action' => 'index'),array('class'=>trim($menuActive)=='User'  ? 'menu-top-active' : '')); ?> </li>
                            <li> <?php echo $this->Html->link('Vendor',array('controller'=>'vendors','action' => 'index'),array('class'=>trim($menuActive)=='Vendor'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('Product',array('controller'=>'products','action' => 'index'),array('class'=>trim($menuActive)=='Product'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('PO',array('controller'=>'orders','action' => 'index'),array('class'=>trim($menuActive)=='Order'  ? 'menu-top-active dropdown-toggle' : 'dropdown-toggle','data-toggle'=>'dropdown','href'=>'#')); ?>
                              <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('PO List',array('controller'=>'orders','action' => 'index'),array('style'=>'color:#222;','href'=>'#')); ?></li> 								<li><?php echo $this->Html->link('Create PO',array('controller'=>'orders','action' => 'addproduct'),array('style'=>'color:#222;','href'=>'#')); ?></li> 
							  </ul>
                              </li>
                              
                                   
                             <li> <?php echo $this->Html->link('Invoice',array('controller'=>'invoices','action' => 'index'),array('class'=>trim($menuActive)=='Invoice'  ? 'menu-top-active dropdown-toggle' : 'dropdown-toggle','data-toggle'=>'dropdown','href'=>'#')); ?>
                             <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Invoice List',array('controller'=>'invoices','action' => 'index'),array('style'=>'color:#222;','href'=>'#')); ?></li>
                                    <li><?php echo $this->Html->link('Invoice Entry',array('controller'=>'invoices','action' => 'add'),array('style'=>'color:#222;','href'=>'#')); ?></li> 
							  </ul>
                             </li>
                             <li> <?php echo $this->Html->link('Payment',array('controller'=>'payments','action' => 'index'),array('class'=>trim($menuActive)=='Payment' ? 'menu-top-active dropdown-toggle' : 'dropdown-toggle','data-toggle'=>'dropdown','href'=>'#')); ?>
                              <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Payment List',array('controller'=>'payments','action' => 'index'),array('style'=>'color:#222;','href'=>'#')); ?></li>
                                    <li><?php echo $this->Html->link('Payment Entry',array('controller'=>'payments','action' => 'add'),array('style'=>'color:#222;','href'=>'#')); ?></li> 
							  </ul>
                             
                              </li>
                             <li> <?php echo $this->Html->link('Shipping',array('controller'=>'shippings','action' => 'index'),array('class'=>trim($menuActive)=='Shipping'  ? 'menu-top-active dropdown-toggle' : 'dropdown-toggle','data-toggle'=>'dropdown','href'=>'#')); ?>
                              <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('Shipping List',array('controller'=>'shippings','action' => 'index'),array('style'=>'color:#222;','href'=>'#')); ?></li>
                                    <li><?php echo $this->Html->link('Create Shipping',array('controller'=>'shippings','action' => 'add'),array('style'=>'color:#222;','href'=>'#')); ?></li> 
							  </ul>
                             
                             </li>
                             <li> <?php echo $this->Html->link('Inventory',array('controller'=>'inventories','action' => 'index'),array('class'=>trim($menuActive)=='Inventory'  ? 'menu-top-active' : '')); ?> </li>
                             <?php /*?><li> <?php echo $this->Html->link('Settings',array('controller'=>'categories','action' => 'index'),array('class'=>trim($menuActive)=='Settings'  ? 'menu-top-active' : '')); ?> </li><?php */?>
                             <li> <?php echo $this->Html->link('Logout',array('controller'=>'users','action' => 'logout')); ?> </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
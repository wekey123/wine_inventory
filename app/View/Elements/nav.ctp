<!--<header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>info@yourdomain.com
                    &nbsp;&nbsp;
                    <strong>Support: </strong>+90-897-678-44
                </div>

            </div>
        </div>
    </header>-->
    

	<?php
	$menus=array('Dashboard'=>array('dashboard'),'Product'=>array('products'),'User'=>array('users'));
	function getPageName($name, $array){
		foreach($array as $key => $value){
			if(is_array($value) && in_array($name, $value))
				  return $key;
		}
		return 'Dashboard';
	}
	$name=explode('/', $_SERVER['REQUEST_URI']);
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
                             <li> <?php echo $this->Html->link('Product',array('controller'=>'products','action' => 'index'),array('class'=>trim($menuActive)=='Product'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('Orders',array('controller'=>'orders','action' => 'index'),array('class'=>trim($menuActive)=='Orders'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('Invoice',array('controller'=>'invoices','action' => 'index'),array('class'=>trim($menuActive)=='Invoice'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('Shipping',array('controller'=>'shipping','action' => 'index'),array('class'=>trim($menuActive)=='Shipping'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('Inventory',array('controller'=>'inventory','action' => 'index'),array('class'=>trim($menuActive)=='Inventory'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('Settings',array('controller'=>'categories','action' => 'index'),array('class'=>trim($menuActive)=='Settings'  ? 'menu-top-active' : '')); ?> </li>
                             <li> <?php echo $this->Html->link('Logout',array('controller'=>'users','action' => 'logout')); ?> </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
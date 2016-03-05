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
    
 <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html" style="color:#fff">
Wine Inventory
                    <!--<img src="assets/img/logo.png" />-->
                </a>

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img src="img/64-64.jpg" alt="" class="img-rounded" />
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Admin </h4>
                                        <h5>Wine inventory</h5>

                                    </div>
                                </div>
                                <hr />
                                <h5><strong>About us : </strong></h5>
                                We Providing inventory management for liquor
                                <hr />
                                <a href="#" class="btn btn-info btn-sm">Full Profile</a>&nbsp; <a href="login.html" class="btn btn-danger btn-sm">Logout</a>

                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
	<?php
	$menus=array('Dashboard'=>array('dashboard'),'Product'=>array('products'));
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
						<?php echo $menuActive; ?>
                            <li><a <?php echo trim($menuActive)=='Dashboard' ? 'class="menu-top-active"' : '' ?> href="/dashboard">Dashboard</a></li>
                            <li><a <?php echo trim($menuActive)=='Product' ? 'class="menu-top-active"' : '' ?> href="products">Products</a></li>
                            <li><a <?php echo trim($menuActive)=='orders' ? 'class="menu-top-active"' : '' ?> href="orders">Orders</a></li>
                            <li><a <?php echo trim($menuActive)=='invoices' ? 'class="menu-top-active"' : '' ?> href="invoices">Invoice</a></li>
                            <li><a <?php echo trim($menuActive)=='shipping' ? 'class="menu-top-active"' : '' ?> href="shipping">Shipping</a></li>
                            <li><a <?php echo trim($menuActive)=='inventory' ? 'class="menu-top-active"' : '' ?> href="inventory">Inventory</a></li>
							<li><a <?php echo trim($menuActive)=='categories' ? 'class="menu-top-active"' : '' ?> href="categories">Settings</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
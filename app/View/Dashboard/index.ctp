<style>
.dasboard_link{
  color: #fff;
}

a.dasboard_link:hover {
    color: #fff;
	text-decoration: none;
}
</style>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Dashboard</h4>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <!--<div class="alert alert-success">
                    This is a simple admin template that can be used for your small project or may be large projects. This is free for personal and commercial use.
                </div>-->
            </div>

        </div>
        <div class="row">
             <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-one">
                    <i  class="fa fa-venus dashboard-div-icon" ></i>
                    <div class="progress progress-striped active">
<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
</div>
                       
</div>
					 <?php echo $this->Html->link('Products',array('controller'=>'products','action' => 'index'),array('class'=>'dasboard_link')); ?>
                </div>
            </div>
             <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-two">
                    <i  class="fa fa-edit dashboard-div-icon" ></i>
                    <div class="progress progress-striped active">
<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
</div>
                       
</div>
                     <?php echo $this->Html->link('Orders',array('controller'=>'orders','action' => 'index'),array('class'=>'dasboard_link')); ?>
                </div>
            </div>
             <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-three">
                    <i  class="fa fa-cogs dashboard-div-icon" ></i>
                    <div class="progress progress-striped active">
<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
</div>
                       
</div>
					 <?php echo $this->Html->link('Invoice',array('controller'=>'invoices','action' => 'index'),array('class'=>'dasboard_link')); ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-four">
                    <i  class="fa fa-bell-o dashboard-div-icon" ></i>
                    <div class="progress progress-striped active">
<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
</div>
                       
</div>
					 <?php echo $this->Html->link('Inventory',array('controller'=>'inventories','action' => 'index'),array('class'=>'dasboard_link')); ?>
                </div>
            </div>

        </div>
     </div>
</div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 2.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventory Management</title>
    <?php 
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('font-awesome');
	echo $this->Html->css('style');
	?>
   
    <style>
	#page-wrapper{
	padding-bottom:20px;
	margin:0px;
	}
	</style>
</head>

<body><?php 
	echo $this->Html->script('jquery-1.11.1');
	echo $this->Html->script('bootstrap');
	?>
    <div id="wrapper">
   	    <?php echo $this->element('headerlogo'); ?>
        <?php   if($this->Session->check('Auth.User')) echo $this->element('nav'); ?>
		
        <?php echo $this->fetch('content'); ?>
    </div>
    <!-- /#wrapper -->
		
</body>
</html>
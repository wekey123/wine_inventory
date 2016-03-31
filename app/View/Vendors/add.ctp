<style>
.varHead label{
	width:25%;
	margin-bottom:0px;
}
.varHead input[type="text"]{
	width:15%;
	float:left;
	margin-right:10%;
	margin-bottom:0px;
}
</style>
    <?php echo $this->Form->create('Vendor'); ?>
<div class="content-wrapper">
    <div class="container">
      <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"><?php echo __('Add Vendor'); ?> </h1>
            </div>
        </div>
               
   <div class="row">           
    <div class="col-md-12" style="margin-right:10%;">     
      
            <div class="row">
                <div class="col-md-5" style="margin-right:10%;">     
            <?php
                echo $this->Form->input('name',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
                echo $this->Form->input('address',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
                echo $this->Form->input('email',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
                echo $this->Form->input('phone',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
            ?>
                </div>
            
                <div class="col-md-5" style="float:right;">     
					<?php 
					 //echo $this->Form->input('role',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>array('admin' => 'Admin', 'staff' => 'Staff'), 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control'));
          			  ?>
                      <div class="panel panel-default">
                            <div class="panel-heading">Add category<span class="error_msg_var"></span> <a id="addcategory" class="btn btn-primary addmore">Add More Coloumns</a><!--<span class="varient-enable glyphicon glyphicon-plus"></span>--></div>              
                            <div class="panel-body" id="varient_body">           
                            <table style="width: 100%;"><tr><th>Sno</th><th>Category Name</th></tr></table>
                             <div id='TextBoxesGroup'></div>
                             
                            </div>
                               <input type="hidden" name="" id="countValues" value="1" />
                      </div>

                </div>
            </div>
            
            <div class="row">
               <div id="varient-wrapper"></div>
               
           </div>
            
     </div>
    </div>
  <?php 
				echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); 
				echo $this->Form->end();	
				?>		   
    <script>
		 var counter =$('#countValues').val();
		$('#addcategory').on('click',function(e){
			if(counter>10){
					alert("Only 10 textboxes allow");
					return false;
			}else{
			var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
						
			newTextBoxDiv.after().html('<table style="width: 100%;"><tr><td>' + counter + '</td> <td><input type="text" id="category' + counter + '" name="data[Vendor][Category]['+ counter +']" class="form-control " style="margin-right:1%" /> <a style="float:right;" onClick="boxRemove('+counter+')" rel="' + counter + '">remove</a></td></tr></table>');
					
			newTextBoxDiv.appendTo("#TextBoxesGroup");
			counter++;
		  }
	  });
	function boxRemove(id){
			 $("#TextBoxDiv" + id).remove();
		 }
	</script>
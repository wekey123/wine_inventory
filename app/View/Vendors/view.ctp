<div class="content-wrapper">
        <div class="container">    
        	  <div class="row">
                  <div class="col-md-12">
                  <?php echo $this->Html->link('Edit Vendor', array('action' => 'edit',$vendor['Vendor']['id']),array('class'=>'btn btn-primary','style'=>'margin-bottom:20px; float:right')); ?>
                    <h4 class="page-head-line"><?php echo __('Vendor View'); ?></h4>
                  </div>
                  <?php if(!empty($this->Flash->render())){ ?>
              	  <div class="col-md-12">
               		 <h5 style="color:#F0677C; float: left;"><?php echo $this->Flash->render(); ?></h5>
       			  </div>
                  <?php } ?>
                  <div class="col-md-12" style="color:#000000; text-align:center; font-size:20px;">
                       			Vendor Details
                  </div>
            </div><br/>      
            
            <div class="row">
                        <div class="col-md-12">
                        

                            <div class="alert alert-warning">
                               <strong><?php echo __('Vendor Name'); ?></strong> <span> : </span> <span><?php echo h($vendor['Vendor']['name']); ?></span> <br />
                               <strong><?php echo __('Address'); ?></strong> <span> : </span> <span><?php echo h($vendor['Vendor']['address']); ?></span> <br />
                               <strong><?php echo __('Phone'); ?></strong> <span> : </span> <span><?php echo h($vendor['Vendor']['phone']); ?></span> <br />
                               <strong><?php echo __('Email'); ?></strong> <span> : </span> <span><?php echo $vendor['Vendor']['email']; ?></span> <br />
                               <strong><?php echo __('Created By'); ?></strong> <span> : </span> <span><?php  echo $vendor['Vendor']['created'];  ?></span> <br />
                               <strong><?php echo __('Modified By'); ?></strong> <span> : </span> <span><?php  echo $vendor['Vendor']['modified']  ?></span> <br />
                            </div>
                   
                          
                        
                          
                        </div>
         	</div>
            
            <div class="row">
              <div class="col-md-12">
              
               <div class="panel panel-default">
                        <div class="panel-heading">
                            Category Name
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                             <table class="table table-hover">
                            <tr><th>Sno</th><th>Name</th></tr>
                            <?php $i = 1; foreach ($vendor['Category'] as $category){ ?>
                               <tr><td> <?php echo h($i); ?></td><td><?php echo h($category['name']); ?></td></tr>
							<?php $i++; } ?>                  
                            </table>
                          </div>
                       </div>
			</div>
        </div>
    </div>
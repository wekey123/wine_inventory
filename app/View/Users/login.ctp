<!--app/View/Users/login.ctp-->
<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line"><?php echo __('Login'); ?></h1>
                </div>
            </div>
            
            <div class="row">
            <div class="col-md-6">
            <h5 style="color:#F0677C"><?php echo $this->Flash->render(); ?></h4>
            <?php echo $this->Form->create('User'); ?>
                    <?php echo $this->Form->input('username',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
                    echo $this->Form->input('password',array('div'=>false,'error'=>false,'type'=>'password', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
                ?>
            <?php echo $this->Form->input('Login',array('div'=>false,'error'=>false,'type'=>'submit', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'btn btn-info')); 
			?>
            
            <?php echo $this->Form->end(); ?>
            </div>
            </div>
       </div>
</div>

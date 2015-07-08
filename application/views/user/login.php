<div class="main-wrapper no-margin">



<div class="container">
    
     <div class="omb_login">
         <?php if($this->session->flashdata('error')){ ?>
             
            <div class="alert alert-danger col-md-offset-3 col-lg-offset-3 col-md-6" role="alert" style="margin-top: 20px; text-align: center">
                <strong>Oh snap!</strong> <?php echo $this->session->flashdata('error'); ?>.
            </div>
                
          <?php } ?>
    	<h3 class="omb_authTitle col-md-12">Login or <a href="<?php echo base_url('user/register') ?>">Sign up</a></h3>
		<div class="row omb_row-sm-offset-3 omb_socialButtons">
    	    <div class="col-xs-6 col-sm-3">
		        <a href="<?php echo $login_url ?>" class="btn btn-lg btn-block omb_btn-facebook">
			        <i class="fa fa-facebook visible-xs"></i>
			        <span class="hidden-xs">Facebook</span>
		        </a>
	        </div>
        	<div class="col-xs-6 col-sm-3">
		        <a href="#" class="btn btn-lg btn-block omb_btn-twitter">
			        <i class="fa fa-twitter visible-xs"></i>
			        <span class="hidden-xs">Twitter</span>
		        </a>
	        </div>	
		</div>

		<div class="row omb_row-sm-offset-3 omb_loginOr">
			<div class="col-xs-12 col-sm-6">
				<hr class="omb_hrOr">
				<span class="omb_spanOr">or</span>
			</div>
		</div>

		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">
                           
                            <?php 
                            echo form_open('', array('class'=>'omb_loginForm',  'autocomplete'=>'off')) ?>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <?php echo form_input(array('class' => 'form-control', 'name'=>'email', 'value'=> isset($_POST['email']) ? $_POST['email'] : '', 'placeholder' => 'email address')) ?>
					</div>
                                        <?php echo form_error('email')?>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <?php echo form_password(array('class' => 'form-control', 'name'=>'password', 'placeholder' => 'Password')) ?>
					</div>
                                        <?php echo form_error('password') ?>
                                        <?php echo form_submit(array('class' => 'btn btn-lg btn-primary btn-block', 'value' => 'Login'))?>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-sm-6">
                                                <label class="checkbox">
                                                    <?php echo form_checkbox(array('name' =>'remember-me')) ?>Remember Me
                                                </label>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <p class="omb_forgotPwd">
                                                    <a href="#">Forgot password?</a>
                                                </p>
                                            </div>
                                        </div>	
				<?php echo form_close(); ?>
			</div>
    	</div>
		    	
	</div>

        </div>

</div>
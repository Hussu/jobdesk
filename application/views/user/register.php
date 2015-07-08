<div class="main-wrapper no-margin">



<div class="container">
    

    <div class="omb_login">
        <h3 class="omb_authTitle">Sign up or <?php echo anchor(base_url('user/login'), 'Login') ?></h3>
		<div class="row omb_row-sm-offset-3 omb_socialButtons">
    	    <div class="col-xs-6 col-sm-3">
		        <a href="<?= $login_url ?>" class="btn btn-lg btn-block omb_btn-facebook">
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
                            <?php echo form_open('', array('class'=>'omb_loginForm')) ?>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <?php echo form_input(array('class'=>'form-control', 'name' => 'first_name',  'value'=> isset($_POST['first_name']) ? $_POST['first_name'] : '', 'placeholder' => 'First Name')) ?>
					</div>
                                        <?php echo form_error('first_name'); ?>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <?php echo form_input(array('class' =>'form-control',  'name'=>'last_name', 'value'=> isset($_POST['last_name']) ? $_POST['last_name'] : '', 'placeholder'=> 'Last Name')) ?>
					</div>
                                        <?php echo form_error('last_name'); ?>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <?php echo form_input(array('class' =>'form-control',  'name'=>'email' , 'value'=> isset($_POST['email']) ? $_POST['email'] : '', 'placeholder'=> 'Email address')) ?>
					</div>
                                        <?php echo form_error('email'); ?>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <?php echo form_password(array('class' =>'form-control',  'name'=>'password' ,'placeholder'=> 'Password')) ?>
					</div>
                                        <?php echo form_error('password'); ?>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <?php echo form_password(array('class' =>'form-control',  'name'=>'confirm_password' , 'placeholder'=> 'Confirm Password')) ?>
                                                <input type="hidden" name="status" value="1">
                                                <input type="hidden" name="access" value="1">
					</div>
                                        <?php echo form_error('confirm_password'); ?>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                                 <?php echo form_input(array('class' =>'form-control',  'name'=>'phone' ,'value'=> isset($_POST['phone']) ? $_POST['phone'] : '', 'placeholder'=> 'Phone')) ?>
					</div>
                                        <?php echo form_error('phone'); ?>
										
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
                                                <?php echo form_input(array('id' => 'autocomplete', 'class'=>'form-control', 'value'=> isset($_POST['address']) ? $_POST['address'] : '', 'onFocus'=>'geolocate()', 'name'=>'address', 'placeholder'=>'Address')) ?>
					</div>
                                        <?php echo form_error('address'); ?>
          
          <h2>Account Type</h2>
          <div class="row form-group product-chooser">
          
          	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          		<div class="product-chooser-item selected">
          			<i class="fa fa-user img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12"></i>
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
          				<span class="title">Buyer</span>
                                        <?php echo form_radio(array('name'=> 'role', 'value' => 3, 'checked'=>'checked')) ?>
          			</div>
          			<div class="clear"></div>
          		</div>
          	</div>
          	
          	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          		<div class="product-chooser-item">
          			<i class="fa fa-user img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12"></i>
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
          				<span class="title">Seller</span>
                                        <?php echo form_radio(array('name'=> 'role', 'value' => 2)) ?>
          			</div>
          			<div class="clear"></div>
          		</div>
          	</div>
          </div>

                                         <?php echo form_submit(array('class' =>'btn btn-lg btn-primary btn-block',  'value'=>'Register' )) ?>
				<?php echo form_close() ?>
			</div>
    	</div>
	</div>



        </div>

</div>

<div class="container">
    <div class="col-md-12">
        <h2>Profile</h2> 
        <div class="tab-wrap">
            <div class="media">
                <div class="parrent pull-left">
                    <ul class="nav nav-tabs nav-stacked">
                        <li class="active"><a class="analistic-01" data-toggle="tab" href="#tab1">Basic</a></li>
                        <li class=""><a class="analistic-02" data-toggle="tab" href="#tab2" onclick="">My Portfolio</a></li>
                        <li class=""><a class="tehnical" data-toggle="tab" href="#tab3">My Hourlies</a></li>
                        <li class=""><a class="tehnical" data-toggle="tab" href="#tab4">My Seller Activity</a></li>
                        <li class=""><a class="tehnical" data-toggle="tab" href="#tab5">My Buyer Activity</a></li>
                    </ul>
                </div>

                <div class="parrent media-body">
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <?php if(!empty($user_data->cover_image)): $cover_img = assets_path('uploads/cover/'.$user_data->cover_image); $text = 'Change Cover'; else: $cover_img = '';  $text = 'Upload Cover'; endif; ?>
                            <div class="col-md-12" id="cover-image-div" style="min-height: 160px; background-position:center; background-image: url('<?php echo $cover_img ?>');   border: 1px solid #e8e8e8; border-radius: 13px; ">
                                <a href="#" onclick="$('#cover_image').trigger('click'); " class="btn btn-hover btn-default" style="margin:auto; left:0; right:0; position: absolute; width:120px; height: 35px;  bottom: 0 "><?php echo $text ?></a>
                                <?php echo form_open('cover_image', array('id' => 'cover_image_form', 'enctype' => 'multipart/form-data'));
                                       echo form_upload(array('name' => 'cover_image', 'id'=> 'cover_image', 'style' => 'display:none'));
                                       echo form_close();
                                ?>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="alert-success alert col-md-10" id="profile_form_success" style="padding: 9px;display: none">Profile Updated Successfully</div>
                                    <div class="col-md-2 pull-right">
                                        <a data-target="#myModal" data-toggle="modal" class=" btn btn-sm btn-primary pull-right">Edit</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a href="#" class="thumbnail" data-toggle="tooltip" title="Upload Profile Image" onclick="$('#profile_image').trigger('click'); " style="margin-top: -97px; position:absolute; border-radius: 50%;">
                                        <?php $image_path = !empty($user_data->profile_image) ? assets_path('uploads/profile/'.$user_data->profile_image) : assets_path('images/default_profile.jpg')?>
                                        <img src="<?php echo $image_path; ?>" class="profile-image" width="150">
                                    </a>
                                </div>
                                <?php echo form_open('profile_image', array('id' => 'profile_image_form', 'enctype' => 'multipart/form-data'));
                                       echo form_upload(array('name' => 'profile_image', 'id'=> 'profile_image', 'style' => 'display:none'));
                                       echo form_close();
                                ?>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">Full Name</div>
                                        <div class="col-md-9"><?php echo isset($user_data->first_name) ? $user_data->first_name.' '.$user_data->last_name: ''; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Job Title</div>
                                        <div class="col-md-9"><?php echo isset($user_data->job_title) ? $user_data->job_title : '' ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Phone</div>
                                        <div class="col-md-9"><?php echo isset($user_data->phone) ? $user_data->phone : '' ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">PER HOUR RATE</div>
                                        <div class="col-md-9"><?php echo isset($user_data->per_hour_rate) ? $user_data->per_hour_rate : '' ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Location</div>
                                        <div class="col-md-9"><?php echo isset($user_data->address) ? $user_data->address : '' ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">About You</div>
                                        <div class="col-md-9">
                                            <?php echo isset($user_data->about_me) ? $user_data->about_me : '' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab2" class="tab-pane">
                            <div class="alert-success alert col-md-10" id="portfolio_form_success" style="padding: 9px;display: none">Portfolio Inserted Successfully</div>
                                <div class="col-md-2 pull-right">
                                    <a href="#" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#portfolioModel">Add Portfolio</a>
                                </div>
                                <div id="example-1" class="thumbs" >
                                    <?php
                                     if (!empty($portfolio_data)) {
                                         foreach ($portfolio_data as $key => $value) {
                                             ?>
                                             <a rel="prettyPhoto[pp_gal]" href="<?php echo assets_path('uploads/portfolio') . '/' . $value->image; ?>" class="preview">
                                                 <img alt="<?php echo $value->description ?>" src="<?php echo assets_path('uploads/portfolio') . '/' . $value->image; ?>" width="230" style="padding-bottom: 5px">
                                             </a>

                                         <?php
                                         }
                                     }
                                     ?>
                                </div>
                         </div>
                         <div id="tab3" class="tab-pane">
                             <div class="alert-success alert col-md-10" id="hourlies_form_success" style="padding: 9px;display: none">Hourlies Inserted Successfully</div>
                             <div class="col-md-12">
                                 <a class="btn btn-sm btn-primary pull-right"  data-toggle="modal" data-target="#hourliesModel">Add Hourlies</a>
                             </div>
                             <div class="row" style="padding-top:29px">
                                 <div class="col-md-12" id="hourliesDiv"> <?php 
                                    if(!empty($hourlies_data)):
                                        foreach ($hourlies_data as $key => $value):?> 
                                     <div class="col-md-3" style="padding-top: 11px">
                                                <img src="<?php echo assets_path('uploads/hourlies/'.$value->media); ?>" width="200" height="151" title="<?php echo $value->description ?>">
                                            </div> <?php 
                                        endforeach;
                                    endif; ?>
                                 </div>
                             </div>
                         </div>

                         <div id="tab4" class="tab-pane">
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words</p>
                         </div>

                         <div id="tab5" class="tab-pane">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                         </div>
                    </div> <!--/.tab-content-->  
                </div> <!--/.media-body--> 
            </div> <!--/.media-->     
        </div><!--/.tab-wrap-->               
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Edit Your Profile</h4>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger" id="profile_form_error" style="display:none" role="alert"><strong>Oh snap! </strong></div>
        <?php echo form_open('', array('id'=>'update_profile_form')) ?>
          <div class="form-group">
              <?php echo form_label('FIRST NAME:', 'first_name', array('class' => 'control-label')); ?>
              <?php $value =  isset($user_data->first_name) ? $user_data->first_name : '' ?>
              <?php echo form_input(array( 'name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control', 'value' => $value)) ?>
          </div>
          
          <div class="form-group">
              <?php echo form_label('LAST NAME:', 'last_name', array('class' => 'control-label')); ?>
              <?php $value =  isset($user_data->last_name) ? $user_data->last_name : '' ?>
              <?php echo form_input(array( 'name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'value' => $value)) ?>
          </div>
          
          <div class="form-group">
              <?php echo form_label('JOB TITLE:', 'job_title', array('class' => 'control-label')); ?>
              <?php $value =  isset($user_data->job_title) ? $user_data->job_title : '' ?>
              <?php echo form_input(array( 'name' => 'job_title', 'id' => 'job_title', 'class' => 'form-control', 'value' => $value)) ?>
          </div>
            
          <div class="form-group">
              <?php echo form_label('PHONE:', 'phone_n', array('class' => 'control-label')); ?>
              <?php $value =  isset($user_data->phone) ? $user_data->phone : '' ?>
              <?php echo form_input(array( 'name' => 'phone', 'id' => 'phone_n', 'class' => 'form-control', 'value' => $value)) ?>
          </div>
            
            <?php echo form_label('PER HOUR RATE:', 'per_hour_rate', array('class' => 'control-label')); ?>
            <div class="input-group">
              <span class="input-group-addon">$</span>
              <?php $value =  isset($user_data->per_hour_rate) ? $user_data->per_hour_rate : '' ?>
              <?php echo form_input(array( 'name' => 'per_hour_rate', 'id' => 'per_hour_rate', 'class' => 'form-control', 'value' => $value)) ?>
              <span class="input-group-addon">.00</span>
            </div>
            
          <div class="form-group">
              <?php echo form_label('ABOUT ME:', 'about_me', array('class' => 'control-label')); ?>
              <?php $value =  isset($user_data->about_me) ? $user_data->about_me : '' ?>
              <?php echo form_textarea(array( 'name' => 'about_me', 'rows' => 4, 'id' => 'about_me', 'class' => 'form-control', 'value' => $value)) ?>
          </div>
        <?php echo form_close() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update_profile()">SAVE</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="portfolioModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Edit Your Profile</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="portfolio_form_error" style="display:none" role="alert"><strong>Oh snap! </strong></div>
        <?php echo form_open('profile/portfolio', array('id'=>'portfolio_form', 'enctype' => 'multipart/form-data')) ?>
          <div class="form-group">
              <?php echo form_label('Image:', 'portfolio_image', array('class' => 'control-label')); ?>
              <?php echo form_upload(array('name' => 'image', 'id'=> 'portfolio_image', 'class' => 'form-control', 'style' => 'padding: 0px 12px;'));?>
          </div>
          
          <div class="form-group">
              <?php echo form_label('Description:', 'portfolio_description', array('class' => 'control-label')); ?>
              <?php echo form_textarea(array('name' => 'description', 'rows' => 4, 'placeholder'=> 'Enter little description about site', 'id'=> 'portfolio_description', 'class' => 'form-control'));?>
          </div>
        <?php echo form_close() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="portfolio()">SAVE</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hourliesModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Add Hourlies</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="hourlies_form_error" style="display:none" role="alert"><strong>Oh snap! </strong></div>
        <?php echo form_open('profile/hourlies', array('id'=>'hourlies_form', 'enctype' => 'multipart/form-data')) ?>
          <div class="form-group">
              <?php echo form_label('Media:', 'hourlies_media', array('class' => 'control-label')); ?>
              <?php echo form_upload(array('name' => 'media', 'id'=> 'hourlies_media', 'class' => 'form-control', 'style' => 'padding: 0px 12px;'));?>
          </div>
          <?php echo form_label('Price:', 'hourlies_price', array('class' => 'control-label')); ?>
            <div class="input-group">
              <span class="input-group-addon">$</span>
              <?php echo form_input(array( 'name' => 'price', 'id' => 'hourlies_price', 'class' => 'form-control')) ?>
              <span class="input-group-addon">.00</span>
            </div>
          <div class="form-group">
              <?php echo form_label('Description:', 'hourlies_description', array('class' => 'control-label')); ?>
              <?php echo form_textarea(array('name' => 'description', 'rows' => 4, 'placeholder'=> 'Enter little description about site', 'id'=> 'hourlies_description', 'class' => 'form-control'));?>
          </div>
        <?php echo form_close() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="hourlies()">SAVE</button>
      </div>
    </div>
  </div>
</div>

<?php
echo $this->jobdesk->css(['jquery.tosrus.all.css']);
echo $this->jobdesk->script(['form_js.js', 'hammer.js', 'FlameViewportScale.js', 'jquery.tosrus.min.all.js', 'main.js'])?>
<script type="text/javascript" language="javascript">
        jQuery(function( $ ) {
                //	Add a custom filter to recognize images from lorempixel (that don't end with ".jpg" or something similar)
                $.tosrus.defaults.media.image = {
                        filterAnchors: function( $anchor ) {
                                return $anchor.attr( 'href' ).indexOf( 'lorempixel.com' ) > -1;
                        }
                };

                $('#example-1 a').tosrus({
                        buttons: 'inline',
                        pagination	: {
                                add			: true,
                                type		: 'thumbnails'
                        },
                         caption    : {
                          add       : true
                       }
                });
        });
</script>


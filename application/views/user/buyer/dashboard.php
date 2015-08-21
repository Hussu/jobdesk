<div class="main-wrapper no-margin" style=" background-color: rgba(0, 0, 0, 0.6);">
    <div class="container">
        <h2>.</h2>
        <div class="media services-wrap wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
            <div class="com-md-12">
                <div class="col-md-2">
                    <div class="pull-left">
                        <?php $dp = user_meta('profile_image'); $image_path = !empty($dp) ? assets_path('uploads/profile/'.$dp) : assets_path('images/default_profile.jpg') ?>
                        <img src="<?php echo $image_path ?>" width="100" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="media-body">
                        <h3 class="media-heading">Hi <?php echo user_meta('first_name') ?></h3>
                        <p>It's Admin here, the founder and CEO of Jobdesk. I'd like to personally welcome you to our community of high quality freelance talent online.</p>
                        <p>Here's some tips on how to get started:</p>
                        <ol class="clearfix" style="padding: 0">
                            <li>
                                <a class="call-to-action" href="#">Post an Hourlie</a> - Let Buyers know what you can deliver for a fixed price
                            </li>
                            <li>
                                <a class="call-to-action" href="#">Send Proposals</a> - Bid for relevant Jobs when you receive notifications or browse the Jobs listings
                            </li>
                            <li>
                                <a class="call-to-action" href="#">Get Endorsed</a> - Reach out to your network, ask them for an endorsement and move up the ranks
                            </li>
                            <li>
                                <a class="call-to-action" href="#">Share your Profile</a> - Use your network to get more work
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="media services-wrap wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
            <div class="com-md-12">
                <div class="col-md-9">
                    <h2>Treding Hourlies</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(!empty($hourlies_data)): ?>
                            <?php foreach ($hourlies_data as $key => $value) { ?>
                                <div class="col-md-4">
                                    <div class="panel panel-primary dashboard_panel" >
                                        <div class="panel-heading" style="height:39px">
                                            <?php $image_path = !empty($value->profile_image) ? assets_path('uploads/profile/'.$value->profile_image) : assets_path('images/default_profile.jpg')?>
                                            <img src="<?php echo $image_path ?>"  width="20" style="border-radius: 50%; margin: 2px 4px 0 -10px; float: left">
                                            <h3 class="panel-title" style="margin:0; float: left"><?php echo $value->first_name ?></h3>
                                            <h3 class="pull-right" style="margin:0; ">$<?php echo $value->price ?></h3>
                                        </div>
                                        <div class="panel-body">
                                            <img class="responsive" height="160" style="width: 100%" src="<?php echo assets_path('/uploads/hourlies/'.$value->media) ?>" width="197">
                                             <P style="margin-top:5px; min-height: 44px">
                                                 <?php echo character_limiter($value->description, 40) ?>
                                             </P>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="media-body">
                        <h2>Useful Links</h2>
                        <ul style="list-style: none; padding-left: 10px">
                            <li><a href="#">Inbox </a> <span class="pull-right">(2)</span></li>
                            <li><hr></li>
                            <li><a href="#">Availability Settings </a></li>
                            <li><hr></li>
                            <li><a href="#">Payments </a></li>
                            <li><hr></li>
                            <li><a href="<?php echo base_url() ?>job/activity?rel=buyer">Jobs I posted </a>(<?php echo !empty($posted_jobs->total ) ? $posted_jobs->total : 0 ?>)</li>
                            <li><hr></li>
                            <li><a href="#">Hourlies I bought </a></li>
                            <li><hr></li>
                            <li><a href="#">more >></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

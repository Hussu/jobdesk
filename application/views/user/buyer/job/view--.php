<img class="loading" src="<?php echo assets_path('images/loading.gif')?>" style="bottom: 0;left: 0;margin: auto;position: absolute;right: 0;top: 0;z-index: 9999; display:none" >
<div class="main-wrapper" style=" background-color: rgba(0, 0, 0, 0.6);">
    <div class="container">
        <h2>.</h2>
        <div class="media services-wrap wow fadeInDown animated" style=" padding-top:30px;visibility: visible; animation-name: fadeInDown;">
            <div class="col-md-12">
                <div class="col-md-9">
                <?php if($this->session->flashdata('proposal_success')): ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('class') ?> col-md-12"> <?php echo $this->session->flashdata('proposal_success'); ?></div>
               <?php endif; ?>
                <h1 style="color:#4e4e4e"><?php echo $job->title; ?></h1>
                </div>
                <div class="col-md-3">
                     <div class="col-md-7">
                        <strong>End In(Days)</strong>
                        <h1> <strong><?php echo days_left($job->created_at); ?></strong> </h1>
                    </div>
                    <div class="col-md-5" style="padding:0px !important">
                        <strong style="text-transform: uppercase"><?php echo $job->type ?></strong>
                        <h1><strong>$<?php echo $job->rate ?></strong></h1>
                    </div>
                    
                </div>
            </div>
            
            
            <?php if($rel == 'buyer') :?>
            <div class="col-md-12 row" style="">
                <div class="col-md-9">
                    <hr>
                    <h3>Description</h3>
                    <p><strong>Experience Level :</strong> <?php if($job->level == 1){ echo 'Entry level'; }elseif($job->level == 2){ echo 'Intermediate Level' ;}elseif($job->level == 3){echo 'Exper Level'; } ?><p>
                    <p><strong>Estimated Job duration :</strong> <?php echo ucfirst($job->status) ?></p>
                    <p>
                       <?php  echo $job->description; ?>
                    </p>
                                
                 <?php if(!empty($job->assign_to)){ ?>
                    <p><strong>Assigned To</strong> : <?php $userDtata = get_user_data($job->assign_to); echo $userDtata->first_name.' '.$userDtata->last_name ?></p>
                      
                    <h3 id="send_proposal">Work Stream with <?php echo $userDtata->first_name; ?></h3>
                    <hr>
                   
                    <div class="col-md-12" id="workstream_thread" style="">
                        <?php if(!empty($workstream)):
                             foreach ($workstream as $key => $value) {
                                if($value->sender == $job->user_id): ?>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img class="browse_job_user_img" style="margin-top: 33px;" src="<?php echo assets_path('uploads/profile/'.$value->profile_image) ?>">
                                    </div>
                                    <div class="col-md-11">
                                        <h6><?php echo nice_date($value->time, 'd M Y') ?></h6>
                                         <p class="alert alert-success" id="othermsg" ><?php echo $value->message ?></p>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img class="browse_job_user_img" style="margin-top: 33px;" src="<?php echo assets_path('uploads/profile/'.$value->profile_image) ?>">
                                    </div>
                                    <div class="col-md-11">
                                        <h6><?php echo nice_date($value->time, 'd M Y') ?></h6>
                                         <p class="alert alert-success" id="othermsg" ><?php echo $value->message ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>
                                 
                        <?php } endif;?>
                    </div>
                    <div class="col-md-12" style="padding:0px">
                        <input type="hidden" name="sender" value="<?Php echo $job->user_id?>">
                        <input type="hidden" name="receiver" value="<?Php echo $job->assign_to?>">
                        <input type="hidden" name="job_id" value="<?Php echo $job->id?>">
                        <textarea class="form-control" id="workstream-textarea" placeholder="Press Enter to send your message"></textarea>
                    </div>
                    
                 <?php }else { ?>
                    <h3 id="send_proposal">All Proposals</h3>
                    <hr>
                    
                    <?php if(!empty($proposals)): foreach($proposals as $key => $value): ?>
                    <div class="col-md-12 single-proposal">
                        <div class="col-md-8">
                            <div class="col-md-2">
                                <?php $image_path = !empty($value->profile_image) ? assets_path('uploads/profile/'.$value->profile_image) : assets_path('images/default_profile.jpg')?>
                                <img src="<?php echo $image_path ?>" style="width:70px;">
                            </div>
                            <div class="col-md-4">
                                <?php echo $value->first_name ?>
                                <div class="row col-md-12">
                                    <strong><?php $addressArray = explode(',', $value->address); echo end($addressArray); ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 style="margin-top:0">$<?php echo $value->amount ?></h3>
                            <p>Fixed Price<p>
                            <form method="post">
                                <input type="hidden" name="user_id" value="<?php echo $value->user_id ?>">
                                <input type="hidden" name="job_id" value="<?php echo $job->id ?>" >
                                <input type="hidden" name="job_slug" value="<?php echo $job->slug ?>" >
                                <button type="submit" class="btn btn-proposal-inverse" id="accept_proposal" data-id="<?php echo $value->user_id ?>">Accept</button>
                            </form>
                        </div>
                        <div class="col-md-12 row">
                            <div class="accordion">
                                <div id="accordion<?php echo $key ?>" class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading active">
                                            <h3 class="panel-title">
                                                <a href="#collapseThree<?php echo $key ?>" data-parent="#accordion<?php echo $key ?>" data-toggle="collapse" class="accordion-toggle collapsed">
                                                    <?php echo word_limiter($value->detail, 6) ?>
                                                    <i class="fa fa-plus pull-right"></i>
                                                </a>
                                            </h3>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseThree<?php echo $key ?>" style="height: 0px;">
                                            <div class="panel-body">
                                                <?php echo $value->detail ?>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--/#accordion1-->
                            </div>
                        </div>
                    </div>
                    <?php endforeach;                     endif;?>
                <?php } ?>
                </div>
                <div class="col-md-3">
                   
                </div>
            </div>
            <?php elseif($rel == 'seller'): ?>
                <div class="col-md-12 row" style="">
                    <div class="col-md-9">
                        <hr>
                        <h3>Description</h3>
                        <p><strong>Experience Level :</strong> <?php if($job->level == 1){ echo 'Entry level'; }elseif($job->level == 2){ echo 'Intermediate Level' ;}elseif($job->level == 3){echo 'Exper Level'; } ?><p>
                        <p><strong>Estimated Job duration :</strong> <?php echo ucfirst($job->status) ?></p>
                        <p>
                           <?php  echo $job->description; ?>
                        </p>

                     <?php if(!empty($job->assign_to)){ ?>
                        <p><strong>Buyer</strong> : <?php $userDtata = get_user_data($job->user_id); echo $userDtata->first_name.' '.$userDtata->last_name ?></p>
                     <?php } ?>
                        <h3 id="send_proposal">Workstream With <?php echo $userDtata->first_name?></h3>
                        <hr>
                        
                        <div class="col-md-12" id="workstream_thread" style=" background:rgba(0, 0, 0, 0.04)">
                            <?php if(!empty($workstream)):
                                 foreach ($workstream as $key => $value) {
                                    if($value->sender == $job->assign_to): ?>
                                    <p class="pull-right alert alert-info" id="mymsg" style="background-color: rgba(0, 0, 0, 0.6); color:white"><?php echo $value->message ?></p>
                                    <?php else: ?>
                                    <p class="pull-left alert alert-success" id="othermsg" ><?php echo $value->message ?></p>
                                    <?php endif; ?>
                            <?php } endif;?>
                        </div>
                        <div class="col-md-12" style="padding:0px">
                            <input type="hidden" name="sender" value="<?Php echo $job->assign_to ?>">
                            <input type="hidden" name="receiver" value="<?Php echo $job->user_id ?>">
                            <input type="hidden" name="job_id" value="<?Php echo $job->id?>">
                                <textarea class="form-control" id="workstream-textarea" placeholder="Press Enter to send your message"></textarea>
                        </div>

                        
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php echo $this->jobdesk->script(['form_js.js']); ?><?php ?>

<script>        
    $(document).ready(function(){
        $("#workstream_thread").scrollTop($("#workstream_thread")[0].scrollHeight);
    })
</script>
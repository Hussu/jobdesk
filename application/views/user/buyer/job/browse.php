 <img class="loading" src="<?php echo assets_path('images/loading.gif')?>" style="bottom: 0;left: 0;margin: auto;position: absolute;right: 0;top: 0;z-index: 9999; display:none" >
<div class="main-wrapper" style=" background-color: rgba(0, 0, 0, 0.6);">
    <div class="container">
        <h2>.</h2>
        <div class="media services-wrap wow fadeInDown animated" style=" padding-top:30px;visibility: visible; animation-name: fadeInDown;">
<!--            <div class="col-md-12">
                <h1 style="color:#4e4e4e">Find a right job for you!</h1>
            </div>-->
            <div class="col-md-12 row" style="padding-top: 20px">
                <div class="col-md-3">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" placeholder="Search jobs..." class="form-control" id="search_job_box">
                            <span class="input-group-btn">
                                <button type="button" onclick="search_job()" class="btn btn-default">Go!</button>
                            </span>
                        </div>
                    </div>
                    
                    <hr class="row">
                    
                    <div class="row level_sorting">
                        <h5>EXPERIENCE LEVEL</h5>
                        <div class="col-md-12">
                            <input id="entry_level_checkbox" name="level1" value="1" type="checkbox" class="sorting">
                            <label class="control-label" for="entry_level_checkbox"> Entry Level ($)</label>
                        </div>
                        <div class="col-md-12">
                            <input id="entry_level_checkbox" name="level2" value="2" type="checkbox" class="sorting">
                            <label class="control-label" for="entry_level_checkbox">Intermediate ($$)</label>
                        </div>
                        <div class="col-md-12">
                            <input id="entry_level_checkbox" name="level3" value="3" type="checkbox" class="sorting">
                            <label class="control-label" for="entry_level_checkbox">Expert ($$$)</label>
                        </div>
                    </div>
                    
                    <hr class="row">
                    
                    <div class="row">
                        <h5>CATEGORIES</h5>
                        <div class="col-md-12">
                            <ul style="padding-left:20px" class=" categories_ul">
                                <?php if(!empty($categories)):
                                       echo '<li><a href="javascript:void(0)" data-id="" class="sorting act" >All Categories</a></li>';
                                         foreach ($categories as $key => $value) {
                                       echo '<li><a href="javascript:void(0)" data-id="'.$value->id.'" class="sorting" >'.$value->name.'</a></li>';
                                     }
                                endif; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <hr class="row">
                    
                    <div class="row">
                        <h5>Job Type</h5>
                        <div class="col-md-12">
                            <input type="radio" class="sorting" name="job_type" checked="" value="" id="joball">
                            <label class="control-label"  for="joball">All</label>
                        </div>
                        <div class="col-md-12">
                            <input type="radio" class="sorting" value="fixed_type" name="job_type" id="joball">
                            <label class="control-label" for="joball">Fixed</label>
                        </div>
                        <div class="col-md-12">
                            <input type="radio" class="sorting" value="hourly"  name="job_type" id="joball">
                            <label class="control-label" for="joball">Per Hour</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="col-md-12" id="before_single_job"><h1 style="margin-top:5px;margin-right: 5px; float:left">Jobs</h1>  <h3><span class="total_jobs"> <?php echo count($jobs) ?> </span> found</h3></div>
                    <div id="jobsContainer">
                    <?php if(!empty($jobs)):
                        foreach($jobs as $key => $value): ?>
                            <div class="col-md-12 single_job">
                                <div class="col-md-12">
                                    <div class="col-md-10"><a href="detail/<?php echo $value->slug ?>" class="job_title"><?php echo $value->title ?></a></div>
                                    <div class="col-md-2 ">
                                        <span class=""><?php echo $value->type == 'fixed_type'  ? 'FIXED PRICE' : 'PER HOUR'; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6" style="">
                                        <span class=" job_exp" ><?php if($value->level == 1){ echo "$";} elseif($value->level == 2){ echo '$$'; }else{ echo "$$$"; } ?> </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class=" job_price" >$<?php echo $value->rate ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 20px  ">
                                    <div class="col-md-3">
                                        <div class="col-md-3" style="padding-left: 0">
                                            <?php $image_path = !empty($value->profile_image) ? assets_path('uploads/profile/'.$value->profile_image) : assets_path('images/default_profile.jpg')?>
                                            <img src="<?php echo $image_path ?>" class="browse_job_user_img">
                                        </div>
                                        <div class="col-md-9">
                                            <p style="margin-bottom:0; margin-left: 10px"><?php echo $value->first_name ?> </p>
                                            <p style="margin-left: 10px"><strong><?php $addressArray = explode(',', $value->address); echo end($addressArray); ?></strong></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3"><p class="browse-p">Posted <?php  echo timespan(human_to_unix($value->created_at), time(), 1) . ' ago'; ?></p></div>
                                    <div class="col-md-2"><p class="browse-p">Proposals <?php echo total_proposals($value->id) ?></p></div>
                                    <div class="col-md-4"><p class="browse-a"><a href="detail/<?php echo $value->slug ?>" class="bnt btn-lg btn-primary btn-proposal "> SEND PROPOSAL </a></p></div>
                                </div>
                            </div>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
                    <nav class="pull-right">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li><a href="javascript:void(0)" class="nav-active">1</a></li>
                                <li><a href="javascript:void(0)">2</a></li>
                                <li><a href="javascript:void(0)">3</a></li>
                                <li><a href="javascript:void(0)">4</a></li>
                                <li><a href="javascript:void(0)">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->jobdesk->script(['form_js.js']); ?><?php ?>

<script>
    $(document).ready(function(){
        
        
        
    })

</script>
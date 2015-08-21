<div class="main-wrapper" style=" background-color: rgba(0, 0, 0, 0.6);">
    <div class="container">
        <h2>.</h2>
        <div class="media services-wrap wow fadeInDown animated" style=" padding-top:10px;visibility: visible; animation-name: fadeInDown;">
            <?php if($msg = $this->session->flashdata('job_success_page')){ ?><div class="alert alert-success"><?php echo $msg ?></div><?php } ?>
          <div class="col-md-12">
                <h1 style="color:#4e4e4e"><?php echo $rel == 'buyer' ? 'My Buyer Activity' : 'My Seller Activity'; ?></h1>
            </div>
            <div class="col-md-12 row" style="padding-top: 20px">
                <div id="jobsContainer">
                    <?php if(!empty($posted_jobs)):
                        foreach($posted_jobs as $key => $value):
                        ?>
                            <div class="col-md-12 single_job">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <a href="<?php echo base_url('job/view').'/'.$value->slug ?>?rel=<?php echo $this->input->get('rel') ?>" class="job_title"><?php echo $value->title ?></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <p class="">Posted : <?php  echo timespan(human_to_unix($value->created_at), time(), 1) . ' ago'; ?></p>
                                    </div>
                                    <?php if($rel == 'buyer'): ?>
                                    <div class="col-md-2">
                                          <p class="">Proposals : 2</p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-8">
                                        <span class="" >Budget : $<?php echo $value->rate ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php // echo $this->jobdesk->script(['form_js.js']); ?>
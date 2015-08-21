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
                        <strong>FIXED PRICE</strong>
                        <h1><strong>$499</strong></h1>
                    </div>
                    
                    <div class="col-md-12">
                        <a href="#send_proposal" class="btn btn-lg btn-proposal-inverse pull-right" style="width:2 00px">Send Proposal</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 row" style="">
                <div class="col-md-9">
                    <hr>
                    <h3>Description</h3>
                    <p><strong>Experience Level :</strong> <?php if($job->level == 1){ echo 'Entry level'; }elseif($job->level == 2){ echo 'Intermediate Level' ;}elseif($job->level == 3){echo 'Exper Level'; } ?><p>
                    <p><strong>Estimated Job duration :</strong> Ongoing</p>
                    
                    <p style="white-space:pre-line">
                        <?php echo $job->description; ?>
                    </p>
                    <h3 id="send_proposal">New Proposal</h3>
                    <hr>
                    <form method="post" action="<?php echo base_url('job/detail/') ?>">
                        <div class="form-group">
                            <label for="detail">ENTER YOUR PROPOSAL DETAILS</label>
                            <textarea id="detail" required='' name="detail" class="form-control" placeholder="Provide general info about your proposal e.g. what you can deliver and when, why you think you can do the job etc."></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="detail">Amount</label>
                            <input type="text" required='' name="amount" id="detail" class="form-control" placeholder="$ 0.00">
                        </div>
                        <input type="hidden" name="job_id" value="<?php echo $job->id ?>" >
                        <input type="hidden" name="creater_id" value="<?php echo $job->user_id ?>" >
                        <input type="hidden" name="job_slug" value="<?php echo $job->slug ?>" >
                        <div class="form-group col-md-4">
                            <label for="detail">Deposit</label>
                            <input type="text" required='' id="detail" class="form-control" placeholder="$ 0.00" name="deposit">
                        </div>
                        
                          <div class="form-group col-md-4">
                                <br>
                                <button type="submit" class="btn btn-danger btn-lg btn-proposal pull-right" style=" height: 40px">Send</button>
                         </div>
                        
                    </form>
                </div>
                <div class="col-md-3">
                   
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
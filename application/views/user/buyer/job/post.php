<div class="main-wrapper" style=" background-color: rgba(0, 0, 0, 0.6);">
    <div class="container">
        <h2>.</h2>
        <div class="media services-wrap wow fadeInDown animated" style=" padding-top:10px;visibility: visible; animation-name: fadeInDown;">
            <?php if($msg = $this->session->flashdata('job_success_page')){ ?><div class="alert alert-success"><?php echo $msg ?></div><?php } ?>
            <div class="col-md-12">
                <h1 style="color:#4e4e4e">Get your Job Done!</h1>
                <p>Post a Job for Free - Start receiving proposals within minutes<p>
            </div>
            <div class="col-md-12 row" style="padding-top: 20px">
                <div class="col-md-9">
                    <?php echo form_open('', array('id' => 'job_form', 'enctype' => 'multipart/form-data')) ?>
                    
                    <div class="form-group">
                        <?php echo form_label('What do you need to get done?', 'job_title', array('class' => 'control-label')) ?>
                        <?php $value = isset($_POST['job']['title']) ? $_POST['job']['title'] : '' ?>
                        <?php echo form_input(array('name' => 'job[title]', 'class' => 'form-control',  'id' => 'job_title', 'placeholder' => 'e.g. I need a professional website design', 'value' => $value)) ?>
                        <?php echo form_error('job[title]') ?>
                    </div>
                    
                    <div class="row">    
                        <div class="form-group col-md-6">
                            <?php echo form_label('PICK CATEGORY', 'job_category', array('class' => 'control-label')) ?>
                            <?php $value = isset($_POST['job']['cat_id']) ? $_POST['job']['cat_id'] : '' ?>
                            <?php echo form_dropdown(array('name' => 'job[cat_id]', 'class' => 'form-control', 'id' => 'job_category'), $cat, $value)?>
                            <?php echo form_error('job[cat_id]') ?>
                        </div>

                        <div class="form-group col-md-6">
                            <?php $value = isset($_POST['job']['cat_id']) ? $_POST['job']['cat_id'] : '' ?>
                            <?php echo form_label('Subcategory', 'job_subcategory', array('class' => 'control-label')) ?>
                            <?php echo form_dropdown(array('name' => 'job[subcat_id]', 'class' => 'form-control', 'id' => 'job_subcategory', 'disabled' => ''), array('0' => 'Subcategory'))?>
                            <?php echo form_error('job[subcat_id]') ?>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <?php $value = isset($_POST['job']['description']) ? $_POST['job']['description'] : '' ?>
                        <?php echo form_label('DESCRIPTION', 'job_des', array('class' => 'control-label')) ?>
                        <?php echo form_textarea(array('name' => 'job[description]', 'rows' => 5, 'class' => 'form-control',  'id' => 'job_des', 'placeholder' => 'Provide a more detailed description to help you get better proposals', 'value' => $value)) ?>
                        <?php echo form_error('job[description]') ?>
                    </div>
                    
                    <?php echo form_label('UPLOAD SAMPLES AND OTHER HELPFUL MATERIAL', 'job_attachment', array('class' => 'control-label')) ?>
                    <div class="form-group">
                        <div class="job_attachment">
                            <span>
                                Drop files here or <a href="#"> Browse </a>
                                to add attachments
                            </span>
                            <?php echo form_upload(array('name' => 'attachment', 'id' => 'job_attachment')) ?>
                        </div>
                    </div>
                       
                    <div class="row">    
                        <div class="form-group col-md-6">
                            <?php $work_type = array('fixed_type' => 'Fixed Type', 'hourly' => 'Per Hour');  ?>
                            <?php echo form_label('WORK TYPE', 'job_type', array('class' => 'control-label')) ?>
                            <?php $value = isset($_POST['job']['type']) ? $_POST['job']['type'] : '';?>
                            <?php echo form_dropdown(array('name' => 'job[type]', 'class' => 'form-control', 'id' => 'job_type'), $work_type, $value)?>
                            <?php echo form_error('job[type]') ?>
                        </div>

                        <?php echo form_label('Rate:', 'job_rate', array('class' => 'control-label')); ?>
                        <div class="input-group" style="width: 48%">
                            <span class="input-group-addon">$</span>
                            <?php $value = isset($_POST['job']['rate']) ? $_POST['job']['rate'] : '' ?>
                            <?php echo form_input(array('name' => 'job[rate]', 'id' => 'job_rate', 'class' => 'form-control', 'value' => $value)) ?>
                            <span class="input-group-addon">.00</span>
                        </div>
                            <?php echo form_error('job[rate]') ?>
                    </div>
                    
                    <?php echo form_label('EXPERIENCE LEVEL', '', array('class' => 'control-label')) ?>
                    <?php echo form_hidden('job[level]'); ?>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <div class="panel panel-primary experience_panel" id="panel1" style="background-color: white" data-value="1">
                                <div class="panel-heading">
                                    <p class="panel-title experience_level">ENTRY LEVEL</p>
                                </div>
                                <div class="panel-body">
                                    Freelancers with lower rates and less experience 
                                    <span class="pull-right">$</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-primary experience_panel" id="panel2" style="background-color: white" data-value="2">
                                <div class="panel-heading">
                                    <p class="panel-title experience_level">INTERMEDIATE</p>
                                </div>
                                <div class="panel-body">
                                    Freelancers with average rates and experience
                                    <span class="pull-right">$$</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 row-odd">
                            <div class="panel panel-primary experience_panel" id="panel3" style="background-color: white" data-value="3">
                                <div class="panel-heading">
                                    <p class="panel-title experience_level">EXPERT</p>
                                </div>
                                <div class="panel-body">
                                    Freelancers with higher rates and more experience
                                    <span class="pull-right">$$$</span>
                                </div>
                            </div>
                        </div>
                            <?php echo form_error('job[level]') ?>
                    </div>
                    
                    <?php echo form_submit(array('class' => 'btn-lg btn btn-primary', 'value' => 'POST JOB')) ?>
                 
                    <?php echo form_close(); ?>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success" style="border: 1px solid #8D8D8D;" >
                        <div class="panel-heading experience_level_heading_selected">
                            <h3 class="panel-title">Buyer Tips</h3>
                        </div>
                        <div class="panel-body">
                            <ol style="padding-left: 18px;">
                                <li>Post your Job for free specifying what you need done.</li>
                                <li>Receive Proposals from quality Freelancers and chat with them.</li>
                                <li>Select your Freelancers based on their profile and feedback.</li>
                                <li>Pay only if satisfied with the work delivered.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->jobdesk->script(['form_js.js']); ?>
<img class="loading" src="<?php echo assets_path('images/loading.gif')?>" style="bottom: 0;left: 0;margin: auto;position: absolute;right: 0;top: 0;z-index: 9999; display:none" >
<div class="main-wrapper" style=" background-color: rgba(0, 0, 0, 0.6);">
    <div class="container">
        <h2>.</h2>
        <div class="media services-wrap wow fadeInDown animated" style=" padding-top:30px;visibility: visible; animation-name: fadeInDown;">
            <div class="col-md-12">
                <h1 style="color:#4e4e4e"><?php echo $job->title; ?></h1>
            </div>
            <div class="col-md-12 row" style="padding-top: 20px">
                <div class="col-md-9">
                    <hr>
                    <h3>Description</h3>
                    <p><strong>Experience Level :</strong> Intermediate<p>
                    <p><strong>Estimated Job duration :</strong> Ongoing</p>
                    
                    <p>
                        <?php echo $job->description; ?>
                    </p>
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
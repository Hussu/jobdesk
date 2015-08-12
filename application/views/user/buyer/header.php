<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Job Desk">
    <meta name="author" content="">
    <title>Job Desk</title>
	
	<!-- core CSS -->
    <?php
        echo $this->jobdesk->css(
                [
                    'bootstrap.min.css',
                    'font-awesome.min.css',
                    'animate.min.css',
                    'prettyPhoto.css',
                    'responsive.css',
                    'custom.css',
                    'main.css',
                ]
        );
        echo $this->jobdesk->script(['jquery.js']);
    ?>
 
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo assets_path() ?>/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo assets_path() ?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo assets_path() ?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo assets_path() ?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo assets_path() ?>/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body class="homepage">
    <?php 
        $ci = & get_instance();
        if($ci->router->fetch_class() != 'index' && $ci->router->fetch_method() != "index"){ ?>
        <style>#main-slider{display: none;} .top-bar{  height: 49px;} ul.social-share i.fa { line-height: inherit;} .navbar-header a.navbar-brand { margin-top: 2px;}</style>
    <?php }
    
    ?>

    <header id="header">
       <?php if(!$this->session->userdata('jodbesk_id')){ ?>
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +0123 456 70 90</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->
       <?php } ?>
        <nav class="navbar navbar-inverse" style="z-index:1">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('') ?>"><img src="<?php echo assets_path() ?>/images/logo1.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url() ?>">HOME</a></li>
                        <li><a href="<?php echo base_url('buy') ?>">BUY</a></li>
                        <li><a href="<?php echo base_url('job/browse') ?>">SELL</a></li>
                        <li><a href="<?php echo base_url('works') ?>">HOW IT WORKS</a></li>
                        <li><a href="<?php echo base_url('job/post') ?>" class="btn btn-default color-black">POST JOB</a></li> 
                        <?php
                          $user_id = is_logged_in();
                          if($user_id) { 
                              ?>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi <?php echo user_meta('first_name') ?> <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dashboard_dropdown">
                                    <li><a href="<?php echo base_url('/dashboard') ?>"><i class="fa fa-tachometer"></i>DASHBOARD</a></li>
                                    <li><a href="<?php echo base_url('/profile') ?>"><i class="fa fa-user"></i>PROFILE</a></li>
                                    <li><a href="404.html"><i class="fa fa-credit-card"></i>PAYMENT</a></li>
                                    <li><a href="<?php echo base_url('job/posted_jobs') ?>"><i class="fa fa-user"></i>MY BUYER ACTIVITY</a></li>
                                    <li><a href="shortcodes.html"><i class="fa fa-user"></i>MY SELLER ACTIVITY</a></li>
                                    <li><a href="shortcodes.html"><i class="fa fa-gear"></i>SETTING</a></li>
                                    <li><a href="<?php echo base_url('user/logout') ?>"><i class="fa fa-power-off"></i>LOGOUT</a></li> 
                                    <li><a href=""><i class="fa fa-phone"></i>CUSTOMER SSUPPORT</a></li> 
                                    <li><a href=""><i class="fa fa-question"></i>HOW IT WORKS</a></li> 
                                </ul>
                            </li>
                            
                            
                            
                          <?php } else{ ?>
                            <li><a href="<?php echo base_url('user/register') ?>">SIGN UP</a></li>
                            <li><a href="<?php echo base_url('user/login') ?>">LOG IN</a></li>                        
                          <?php } ?>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->

    

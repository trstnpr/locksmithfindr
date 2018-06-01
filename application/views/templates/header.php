<!DOCTYPE html>

<html lang="en">

    <head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1, width=device-width">

        <title><?php echo $title; ?></title>

        <meta name="title" content="<?php echo $meta_title; ?>">
        <meta name="keywords" content="<?php echo $meta_keyword; ?>">
        <meta name="description" content="<?php echo $meta_description; ?>">
        <meta name="robots" content="index, follow" />

        <link href="<?php echo base_url('build/css/styles.css?v=1'); ?>" rel="stylesheet">

        <!-- eugenenenewton@gmail.com eugenemenewton -->
        <script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo the_config('ga_id'); ?>', 'auto');
			ga('send', 'pageview');

		</script>

		<script src='https://www.google.com/recaptcha/api.js'></script>

    </head>


    <body>

    	<header>

    		<div class="nav-top hidden-xs data-img" data-bg="<?php echo base_url('build/images/geoblue.jpg'); ?>">
    			<div class="container">
    				
    				<div class="row">
    					<div class="col-md-6">
    						<!-- SOCIAL -->
    						<p class="top-social">Follow Us on&nbsp;&nbsp;&nbsp;<a href="<?php echo the_config('facebook_link'); ?>" title="Facebook"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo the_config('twitter_link'); ?>" title="Twitter"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo the_config('googleplus_link'); ?>" title="Google Plus"><i class="fa fa-google-plus"></i></a></p>
    					</div>
    					<div class="col-md-6">
    						<p class="top-contact">For Inquiries you can <a href="#"><i class="fa fa-phone"></i> Contact Us</a></p>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="nav-brand data-img" data-bg="<?php echo base_url('build/images/geowhite.jpg'); ?>">
    			<div class="container">
	    			<a href="<?php echo base_url(); ?>">
						<img src="<?php echo base_url('build/images/logo.png'); ?>" class="img-responsive center-block" alt="<?php echo the_config('site_name'); ?>" title="<?php echo the_config('site_name'); ?>" />
					</a>
				</div>
    		</div>

    		<nav class="navbar navbar-default main-nav">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="<?php echo base_url(); ?>">Home</a></li>
							<li><a href="<?php echo base_url('blog'); ?>">Blog</a></li>
							<li><a href="<?php echo base_url('states'); ?>">States</a></li>
							<?php if(current_url() == base_url()) { ?>
								<li><a href="#top_cities" class="top-cities">Top Cities</a></li>
							<?php } else { ?>
								<li><a href="<?php echo base_url('#top_cities'); ?>" class="top-cities">Top Cities</a></li>
							<? } ?>
							<li><a href="<?php echo base_url('cast-business') ?>">Cast Business</a></li>
							<li><a href="<?php echo base_url('privacy-policy') ?>">Privacy Policy</a></li>
							<li><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
							
						</ul>
						<form class="navbar-form navbar-right search-directory" method="GET" action="<?php echo base_url('search'); ?>" data-validate="<?php echo base_url('search/validate?location='); ?>">
							<div class="form-group">
								<input type="text" class="form-control keyword" name="location" placeholder="Type your City or Zip Code ..." onKeyUp="strip_char()" id="keyword" data-suggest="<?php echo base_url('search/suggest'); ?>" required />
							</div>
							<button type="submit" class="btn btn-purple">Search</button>
						</form>
					</div>
				</div>
			</nav>

		</header>

        <main>
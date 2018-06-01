<div class="home-content">

    <section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner-bg-1.jpg'); ?>" >

    	<div class="overlay">

	    	<div class="container">

	    		<div class="tagline-wrap">
	    		
		    		<h1><?php echo the_config('tag_line'); ?></h1>

		    		<h4><?php echo the_config('sub_tagline'); ?></h4>

		    	</div>
		    	<br/>
		    	<div class="row">
		    		<div class="col-md-6 col-md-offset-3">
		    			<div class="form-wrap">
			    			<form class="search-directory" method="GET" action="<?php echo base_url('search'); ?>" data-validate="<?php echo base_url('search/validate?location='); ?>">
				    			<div class="input-group">
									<input type="text" class="form-control input-lg keyword" name="location" placeholder="Type your City or Zip Code ..." onKeyUp="strip_char()" id="keyword" data-suggest="<?php echo base_url('search/suggest'); ?>" required />
									<span class="input-group-btn">
										<button type="submit" class="btn btn-purple btn-lg btn-search" type="button" title="Search for Locksmith NOW!"><span class="hidden-xs">Search</span><span class="visible-xs"><span class="fa fa-search"></span></span></button>
									</span>
								</div><!-- /input-group -->
							</form>
						</div>
		    		</div>
		    	</div>

	    	</div>

	    </div>

    </section>

    <section class="section-featured data-img" data-bg="<?php echo base_url('build/images/geowhite.jpg'); ?>">

    	<div class="container">
    		
    		<h2 class="section-title txt-center">Remarkable Services</h2>


    		<div class="featured-wrap">

    			<?php if($yp != 0) { ?>

	    		<div class="row">

	    			<?php
	    			$limit = 0;
	    			foreach($yp as $biz) {
	    				$limit++;
	    				$address1 = ($biz->street != NULL AND $biz->city != NULL) ? $biz->street.', '.$biz->city : 'No Information Given' ;
		    			$address2 = ($biz->city != NULL AND $biz->zip != NULL AND $biz->state != NULL) ? $biz->city.' '.sprintf('%05u', $biz->zip).', '.$biz->state : 'No Information Given' ;
	    			?>

	    			<div class="col-md-3">

	    				<div class="feat-item">

	    					<div class="feat-image">
	    						<span>Featured</span>
	    						<img src="<?php echo $biz->adImage; ?>" class="img-responsive" />
	    					</div>
	    					
	    					<div class="feat-details">

	    						<p class="title"><?php echo $biz->businessName; ?></p>

	    						<ul class="fa-ul">
	    							<li><i class="fa fa-li fa-map-marker"></i> <?php echo $address1; ?></li>
	    							<li><i class="fa fa-li fa-location-arrow"></i> <?php echo $address2; ?></li>
	    							<li><i class="fa fa-li fa-phone"></i> <?php echo $biz->phone; ?></li>
	    						</ul>

	    					</div>

	    				</div>

	    			</div>

	    			<?php if($limit >= 4) { break; } } ?>

	    		</div>

	    		<?php } ?>

	    	</div>

    	</div>

    </section>

    <?php
    $home_blogs = recent_blog(3);
    if(!empty($home_blogs)) {
    ?>
    <section class="section-blogs">

    	<div class="container">
    		
    		<h2 class="section-title txt-center">Blog</h2>


		    <div class="blog-wrap">

				<div class="row">

					<?php
						foreach($home_blogs as $hblog) {
							$thumb = ($hblog->featured_image != NULL) ? base_url($hblog->featured_image) : base_url('build/images/thumb.jpg') ;
					?>

					<div class="col-md-4">

						<div class="blog-item">

							<div class="blog-header">
								<h3 class="blog-title"><?php echo truncate($hblog->title, 30); ?></h3>
							</div>

							<div class="blog-thumb">
								<img src="<?php echo $thumb; ?>" class="img-responsive" alt="<?php echo $hblog->title; ?>" title="<?php echo $hblog->title; ?>" />
							</div>

							<div class="blog-content">

								<span class="blog-date">Posted on <?php echo date_proper($hblog->created_at); ?></span>

								<p class="blog-excerpt">
									<?php echo truncate($hblog->excerpt, 150); ?> 
								</p>

								<br/>

								<a href="<?php echo base_url($hblog->slug); ?>" class="btn btn-danger">Read more</a>

							</div>

						</div>

					</div>

					<?php } ?>

				</div>

			</div>

			

    	</div>

    </section>

    <?php } ?>

    <section class="section-topcity data-img" id="top_cities" data-bg="<?php echo base_url('build/images/geoteal.jpg'); ?>">
    	
    	<div class="container">
    		
    		<h2 class="section-title txt-center">Top Cities</h2>

    		<?php if(!empty(major_area())) { ?>
    		<div class="citylist-wrap">

    			<ul>
    			<?php foreach(major_area() as $popcity) { ?>
			    	<li><a href="<?php echo base_url('city/'.$popcity->slug); ?>"><i class="fa fa-map-marker"></i> <?php echo $popcity->name; ?></a></li>
    			<?php } ?>

			    </ul>

    		</div>
    		<?php } ?>

    	</div>

    </section>

</div>
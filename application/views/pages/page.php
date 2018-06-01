<div class="page-content">

	<section class="section-header data-img" data-bg="<?php echo base_url('build/images/random/5.jpg'); ?>">
		<div class="overlay">
			<div class="container">
				<h1 class="txt-center">
					<?php echo $page->title; ?>
				</h1>
			</div>
		</div>
	</section>

    <section class="section-page">

    	<div class="container">

    		<div class="section-content">

				<div class="content-wrap">

					<?php
						if($page->featured_image != NULL) {
							$blog_thumb = ($page->featured_image != NULL) ? base_url($page->featured_image) : base_url('build/images/thumb.jpg');
					?>
						<div class="content-thumb">
							<img src="" class="img-responsive" alt="<?php echo $page->title; ?>" title="<?php echo $page->title; ?>" /> 
						</div>
						<br/>
					<?php } ?>
    				
					<?php echo $page->content; ?>

    			</div>

			</div>

    	</div>

    </section>

</div>
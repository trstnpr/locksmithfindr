<div class="blog-content">

	<section class="section-header data-img" data-bg="<?php echo base_url('build/images/random/5.jpg'); ?>">
		<div class="overlay">
			<div class="container">
				<h1 class="txt-center">
					Blog
				</h1>
			</div>
		</div>
	</section>

    <section class="section-blog">

    	<div class="container">

    		<div class="section-content">

				<div class="blog-wrap">

				<?php
				if($blogs->result()) {
					foreach($blogs->result() as $blog) {
						$blog_thumb = ($blog->featured_image != NULL) ? base_url($blog->featured_image) : base_url('build/images/thumb.jpg');
				?>

					<div class="blog-item">

						<div class="row">

							<div class="col-md-3">

								<div class="blog-thumb">
									<img src="<?php echo $blog_thumb; ?>" class="img-responsive" alt="<?php echo $blog->title; ?>" title="<?php echo $blog->title; ?>" />
								</div>

							</div>

							<div class="col-md-9">
						
								<div class="blog-body">

									<span class="blog-meta">Posted on <?php echo date_proper($blog->created_at); ?></span>

									<h2 class="blog-title"><?php echo $blog->title; ?></h2>

									<div class="blog-excerpt">
										
										<p><?php echo $blog->excerpt; ?></p>

									</div>

									<br/>

									<a href="<?php echo base_url($blog->slug); ?>" class="btn btn-danger btn-readmore">Read more</a>

								</div>

							</div>

						</div>

					</div>

				<?php
					}

                    if (strlen($pagination)) {
                        echo $pagination;
                    }
				} else { ?>

                
                <h2 class="text-muted text-center">No Blog Posts Available</h2>

                <?php } ?>

					
				</div>


			</div>

    	</div>

    </section>

</div>
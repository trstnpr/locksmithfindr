<div class="states-content">

	<section class="section-header data-img" data-bg="<?php echo base_url('build/images/banner-bg-3.jpeg'); ?>">
		<div class="overlay">
			<div class="container">
				<h1 class="txt-center">States</h1>
				<br/>
				<h4 class="txt-center">Locksmith Services by States</h4>
			</div>
		</div>
	</section>

    <section class="section-states">

    	<div class="container">

			<div class="section-search data-img" data-bg="<?php echo base_url('build/images/geoblue.jpg'); ?>">

				<div class="searchform-wrap">

					<div class="row">
						
						<div class="col-md-8 col-md-offset-2">

							<h2 class="section-label txt-center">Search Locksmith Services</h2>
							
							<?php include('parts/form-search.php'); ?>

						</div>

					</div>

			    </div>
			    
			</div>

			<div class="section-content">

				<div class="states-wrap">
    		
    				<div class="row">
    					<?php

	    					foreach($states as $state) {

	    				?>
    					<div class="col-md-3 col-sm-6 state-item">
    						
							<a href="<?php echo base_url('state/'.strtolower($state->abbrev)); ?>" class="list-state">
								<i class="fa fa-map-pin"></i> <?php echo $state->state; ?>
							</a>
    							
    					</div>
    					<?php } ?>

    				</div>
    				
    			</div>

			</div>

    	</div>

    </section>

</div>
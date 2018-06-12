<?php
//Vars
$section_name = 'testimonial-section';
$starCounter = 0;

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	
	<h2 class="danzerpress-title" style=""><?php echo $section_title; ?></h2>
	
	<?php if ($section_description) { ?>

		<div class="danzerpress-flex-row">
			<div class="danzerpress-two-thirds danzerpress-col-center">
				<p style="text-align: center; font-size: 18px;margin-bottom: 40px;"><?php echo $section_description; ?></p>
			</div>
		</div>

	<?php } ?>

	<div class="danzerpress-flex-row">
		<div class="danzerpress-col-1 danzerpress-col-center">

		 	<div class="danzerpress-flex-row">
		 		<?php 
				// check if the nested repeater field has rows of data
	        	if( have_rows('testimonial_blocks') ):

				 	echo '<div class="danzerpress-flex-row danzerpress-row-fix">';

				 	// loop through the rows of data
				    while ( have_rows('testimonial_blocks') ) : the_row();

						// vars
						$testimonialStars = get_sub_field('testimonial_stars');
						$testimonialContent = get_sub_field('testimonial_content');
						$testimonialImage = get_sub_field('testimonial_image');
						$testimonialName = get_sub_field('testimonial_name');

					

						echo '
							<div class="danzerpress-col-3 danzerpress-md-1 danzerpress-sm-1 danzerpress-xs-1" data-tilt style="transform-style: preserve-3d;">
								<div class="danzerpress-content danzerpress-shadow-2 wow fadeInUp ' . $danzerpressColor . '" style="padding: 40px;text-align: center;border-radius: 2px;">';
									
							while ( $starCounter < $testimonialStars ) {
								echo '<i class="fa fa-star" style="transform: translateZ(20px);"></i>';
								$starCounter++;
							}

							if ($starCounter == $testimonialStars) {
								$starCounter = 0;
							}
									
						echo'
							<p style="font-size: 16px;line-height: 28px;transform: translateZ(20px);">' . $testimonialContent . '</p>
									<div class="danzerpress-image-box"><img src="' . $testimonialImage . '"></div>
									<h4>' . $testimonialName . '</h4>
								</div>
							</div>
						';

					endwhile;

					echo '</div>';

				endif; ?>
			</div>

		</div>
	</div>

<?php danzerpress_sections_footer(); ?>
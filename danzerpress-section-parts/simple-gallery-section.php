<?php
//Vars
$section_name = 'simple-gallery-section';
$section_layout = get_sub_field('section_layout');

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	<div class="danzerpress-flex-row">

		<?php if ( $section_layout == 'simplegallery' ) { ?>
		<div class="danzerpress-two-thirds danzerpress-col-center">
			<h2 class="danzerpress-title" style=""><?php echo $section_title; ?></h2>
			<p style="text-align: center; font-size: 18px;margin-bottom: 40px;"><?php echo $section_description; ?></p>
			
			<?php 
				$images = get_sub_field('section_gallery');
				$size_ml = 'medium_large'; // (thumbnail, medium, large, full or custom size)
				$size_full = 'full'; // (thumbnail, medium, large, full or custom size)

				if( $images ): ?>
				    <div class="danzerpress-flex-row danzerpress-row-fix">
				        <?php foreach( $images as $image ): ?>
				        	<?php
				        		//vars
				        		$image_ml = wp_get_attachment_image_url($image['ID'], $size_ml);
				        		$image_full = wp_get_attachment_image_url($image['ID'], $size_full);

				        	?>
				        	<div class="danzerpress-col-3 danzerpress-md-2 danzerpress-sm-2 danzepress-xs-2 wow slideInUp">
								<div class="danzerpress-image-wrap">
									<a data-fancybox="<?php echo 'simple-gallery-section-' . $section_number; ?>" href="<?php echo $image_full; ?>">
										<img src="<?php echo $image_ml; ?>">
									</a>
								</div>
								<!-- <h4 style="text-align: center; margin-top: 10px;"><?php echo $image['title'] ?></h4> -->
							</div>
				        <?php endforeach; ?>
				    </div>
			<?php endif; ?>

			<?php 
			//Buttons
			include(locate_template('danzerpress-section-parts/content-button.php' )); 
			?>
			
		</div>

	<?php } elseif ( $section_layout == 'fourimages' ) {
		include(locate_template('danzerpress-section-parts/four-image-content.php' )); 
	} elseif ( $section_layout == 'portfolio' ) {
		include(locate_template('danzerpress-section-parts/portfolio-content.php' )); 
	} ?>

	</div>

<?php danzerpress_sections_footer(); ?>
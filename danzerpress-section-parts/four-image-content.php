<div class="danzerpress-four-fifths danzerpress-col-center">
	<div class="danzerpress-flex-row danzerpess-row-fix">

		<div class="danzerpress-col-2 <?php echo $order; ?>">

			<?php 
			// check if the nested repeater field has rows of data
        	if( have_rows('image_repeater') ):

			 	echo '<div class="danzerpress-flex-row">';

			 	// loop through the rows of data
			    while ( have_rows('image_repeater') ) : the_row();

					// vars
					$image = get_sub_field('image');

					echo '
					<div class="danzerpress-col-2 danzerpress-md-2 danzerprss-sm-2 danzerpress-xs-2 wow zoomIn">
						<div class="danzerpress-image-wrap">
						<a data-fancybox="four-image-section" href="' . $image . '"><img src="' . $image . '"></a>
						</div>
					</div>
					';

				endwhile;

				echo '</div>';

			endif; ?>

		</div>
		<div class="danzerpress-col-2 danzerpress-align-center">
			<h2 class="danzerpress-title" style=""><?php echo $section_title; ?></h2>
			<p style="text-align: center; font-size: 18px;margin-bottom: 40px;"><?php echo $section_description; ?></p>
			<?php 
			//Buttons
			include(locate_template('danzerpress-section-parts/content-button.php' )); 
			?>
		</div>
		
	</div>

</div>
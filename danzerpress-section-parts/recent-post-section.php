<?php

//Vars
$section_name = 'recent_post_section';

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	
	<h2 class="danzerpress-title" style="margin-bottom: 40px;"><?php echo $section_title; ?></h2>
	<div class="danzerpress-four-fifths danzerpress-col-center">

		<div class="danzerpress-flex-row danzerpress-row-fix">

			<?php

			/* Vars */
			$post_type = get_sub_field('custom_post_type');
			$posts_per_page = get_sub_field('number_of_posts');
			$category_name = get_sub_field('category_to_display');
			$column_number = get_sub_field('column_number');
			$half_or_whole = get_sub_field('half_or_whole');
			$new_excerpt = get_sub_field('excerpt_length');

			/* Start the Loop */
			$args = array( 
				'post_type' => 'post',
				'posts_per_page' => $posts_per_page,
				'category_name' => $category_name
			);
			$loop = new WP_Query ( $args );
			while ( $loop->have_posts() ) : $loop->the_post();

			if (get_the_post_thumbnail_url()) {
				$recent_post_url = get_the_post_thumbnail_url();
			} else {
				$recent_post_url = get_template_directory_uri() . '/danzerpress-images/no-image.png';
			}

			if ((int)$half_or_whole == 1) { 

				echo '
				<div class="danzerpress-col-' . $column_number . ' danzerpress-flex-column">
						<div class="danzerpress-col-1 danzerpress-fix danzerpress-lineheight-fix danzerpress-flex-column danzerpress-recent-post-section wow fadeIn">
							<div class="whole-section-image-wrap">
								<img class="" src="' . $recent_post_url . '">
							</div>
							<div class="danzerpress-box ' . $danzerpressColor . ' danzerpress-shadow-3">
								<h2>' . get_the_title() . '</h2>
								<p>' . excerpt($new_excerpt) . '</p>
							</div>
						</div>
				</div>
				';


				} else {

					echo 
					'
					<div class="danzerpress-col-2 danzerpress-sm-2 danzerpress-xs-1 danzerpress-flex-row wow fadeIn">
						<div class="danzerpress-col-2 danzerpress-md-1 danzerpress-sm-1 danzerpress-fix danzerpress-lineheight-fix">
							<img class="split-section-image" style="height: 100%;width: 100%;object-fit: cover;" src="' . $recent_post_url . '">
						</div>
						<div class="danzerpress-col-2 danzerpress-md-1 danzerpress-sm-1 danzerpress-flex-column danzerpress-fix">
							<div class="danzerpress-box ' . $danzerpressColor . ' danzerpress-shadow-3">
								<h2>' . get_the_title() . '</h2>
								<p>' . excerpt($new_excerpt) . '</p>
							</div>
						</div>
					</div>
					';

				} 

				endwhile; 
				wp_reset_postdata();

			?>
		</div>

		<?php 
		//Buttons
		include(locate_template('danzerpress-section-parts/content-button.php' )); 
		?>

</div>

<?php danzerpress_sections_footer(); ?>
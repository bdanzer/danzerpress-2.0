<?php
//Vars
$section_name = 'danzerpress-image-section';
$section_layout = get_sub_field('image_or_video' );

// get iframe HTML
if ( get_sub_field('section_video') ) {
	$iframe = get_sub_field('section_video');


	// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $iframe, $matches);
	$src = $matches[1];


	// add extra params to iframe src
	$params = array(
	    'controls'    => 0,
	    'showinfo'    => 0,
	    'rel'		  => 0,
	);

	$new_src = add_query_arg($params, $src);

	$iframe = str_replace($src, $new_src, $iframe);


	// add extra attributes to iframe html
	$attributes = 'frameborder="0" allowfullscreen';

	$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);


	// echo $iframe
	//echo $iframe;
}

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	<div class="danzerpress-flex-row">
		
		<?php if ( $section_layout != 'longimage' ) { ?>
			<div class="danzerpress-col-1 danzerpress-col-center">
				<div class="danzerpress-flex-row danzerpress-row-fix">
					<div class="danzerpress-col-2 <?php echo $order; ?>">
						<div class="danzerpress-image-wrap danzerpress-rectangle wow <?php echo $wowclass; ?>">

							<?php 
							if ( $section_layout == 'image') {
								echo'<img data-fancybox="' . $section_id . '" data-src="' . $section_image . '" class="danzerpress-ab-items" src="' . $section_image . '">';
							} elseif ( $section_layout == 'video' ) {
								echo $iframe;
							}

							?>
						</div>
					</div>
					<div class="danzerpress-col-2 danzerpress-flex-row">
						<div class="danzerpress-section-content danzerpress-align-self">
							<h2 class="danzerpress-title wow fadeIn"><?php echo $section_title; ?></h2>
							<p class="wow fadeIn image-section-p"><?php echo $section_description; ?></p>
							<?php 
							//Buttons
							include(locate_template('danzerpress-section-parts/content-button.php' )); 
							?> 
						</div>
					</div>
				</div>
			</div>
			<?php } elseif ($section_layout == 'longimage') {
				include(locate_template('danzerpress-section-parts/long-image-content.php' )); 
			} ?>

	</div>
<?php danzerpress_sections_footer(); ?>
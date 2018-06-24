<?php
//Vars
$section_name = 'danzerpress-icons-section';
$hero_section = false;
$columns = get_sub_field('number_of_rows');

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?> 
	<?php
	if ($section_image) {
		echo 
		'
		<div class="danzerpress-icon-img wow zoomIn">
			<img src="' . $section_image . '">
		</div>
		';
	}

	?>
	<h2 id="danzerpress-title-1" class="danzerpress-title" style="margin-top: 0px; margin-bottom: 50px;"><?php echo $section_title; ?></h2>
	<div class="danzerpress-flex-row">
		<div class="danzerpress-four-fifths danzerpress-col-center">

			<?php
        	// check if the nested repeater field has rows of data
        	if( have_rows('icons_repeater') ):

			 	echo '<div class="danzerpress-flex-row danzerpress-row-fix">';

			 	// loop through the rows of data
			    while ( have_rows('icons_repeater') ) : the_row();

					// vars
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$description = get_sub_field('description');

					echo '
					<div class="danzerpress-col-' . $columns . ' danzerpress-md-2 danzerpress-sm-2 danzerpress-xs-1">
						<div class="danzerpress-icon-box wow zoomIn">
							<img src="' . $image . '">
						</div>
						<div class="danzerpress-content-box wow fadeInUp">
							<h4>' . $title . '</h4>
							<p>' . $description . '</p>
						</div>
					</div>
					';

				endwhile;

				echo '</div>';

			endif; ?>

			<?php 
			//Buttons
			include(locate_template('danzerpress-section-parts/content-button.php' )); 
			?> 

		</div>
	</div>
<?php danzerpress_sections_footer(); ?>
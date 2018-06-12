<?php
//Vars
$section_name = 'slider-revolution-section';

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	
	<?php echo do_shortcode($section_description); ?>

<?php danzerpress_sections_footer(); ?>
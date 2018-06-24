<?php
//Vars
$section_name = 'danzerpress-block-text-section';

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	<div class="danzerpress-icon-img wow zoomIn">
		<img src="<?php echo $section_image; ?>">
	</div>
	<div class="danzerpress-flex-row">
		<div class="danzerpress-two-thirds danzerpress-col-center wow fadeInUp" style="text-align: justify;">
			<h2 class="danzerpress-title"><?php echo $section_title; ?></h2>
			<div><?php echo $section_description; ?></div>
		</div>
	</div>
	<?php 
	//Buttons
	include(locate_template('danzerpress-section-parts/content-button.php' )); 
	?>
<?php danzerpress_sections_footer(); ?>
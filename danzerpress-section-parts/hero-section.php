<?php

//Vars
$section_name = 'danzerpress-hero-section';
$hero_layout = get_sub_field('hero_layout');
$background_type = get_sub_field('background_type');

if ($background_type != 'image' && $background_type != 'color') {
	$danzerpress_font_color = 'danzerpress-color-grey';
} else {
	$danzerpress_font_color = 'danzerpress-color-white';
}

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>

	<div class="danzerpress-flex-row">

		<?php if ($hero_layout == 1) { ?>
		<div class="danzerpress-two-thirds danzerpress-col-center danzerpress-align-center">
			<?php
			if ($section_icon) {
				echo 
				'
				<div class="danzerpress-icon-img wow zoomIn">
					<img src="' . $section_icon . '">
				</div>
				';
			}

			?>
			<div class="danzerpress-section-content">
				<h2 class="danzerpress-title <?php echo $danzerpress_font_color; ?> wow fadeIn" style=""><?php echo $section_title; ?></h2>
				<p class="danzerpress-hero-p <?php echo $danzerpress_font_color; ?> wow fadeIn" style="font-size: 20px;"><?php echo $section_description; ?></p>
				<?php 
				//Buttons
				include(locate_template('danzerpress-section-parts/content-button.php' )); 
				?> 
			</div>
		</div>

		<?php } elseif ($hero_layout == 2 || $hero_layout == 3) {
			include(locate_template('danzerpress-section-parts/hero-section-w-side-image-content.php' ));
		} 
		?>

	</div>
		
<?php danzerpress_sections_footer(); ?>
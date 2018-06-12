<?php
//vars
$section_name = 'half-and-half';
$section_layout = get_sub_field('half_and_half_layout');

if ($section_layout == 2) {
	$danzerpress_font_color = 'danzerpress-color-grey';
	
	if ($section_is_odd == 1){
		$background_class = 'danzerpress-odd';
	} else {
		$background_class = '';
	}

} else {
	$danzerpress_font_color = 'danzerpress-color-white';
	$background_color = 'background: rgba(21, 21, 21, 0.5882352941176471);border-left: 2px solid black;';
}

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>

	<div class="danzerpress-flex-row">

		<div class="danzerpress-container-fw" style="background: none;">
			<div class="danzerpress-flex-row">
				<div class="danzerpress-col-2 danzerpress-fix parallax-window <?php echo $order; ?>" data-parallax="scroll" data-image-src="<?php echo $section_image; ?>" style="display: flex; flex-direction: column; justify-content: center; min-height: 300px;">	
				</div>

				<div class="danzerpress-col-2 danzerpress-fix <?php echo $background_class; ?>" style="display: flex; flex-direction: column; justify-content: center; padding: 140px 0; <?php echo $background_color; ?>">
					<div class="danzerpress-content danzerpress-align-center" style="display: flex; flex-direction: column; justify-content: center; flex: 1 0 auto;">
						<h2 class="danzerpress-title <?php echo $danzerpress_font_color; ?>" style="margin-bottom: 20px; text-align: left; margin-left: 0px;"><?php echo $section_title; ?></h2>
						<p class="<?php echo $danzerpress_font_color; ?>" style="text-align: left;"><?php echo $section_description; ?></p>
						<?php
						//Buttons
						include(locate_template('danzerpress-section-parts/content-button.php' )); 
						?>
					</div>
				</div>
			</div>
		</div>

	</div>
		
<?php danzerpress_sections_footer(); ?>
<div class="danzerpress-col-1 danzerpress-col-center">
	<div class="danzerpress-flex-row danzerpress-row-fix">
		<div class="danzerpress-col-2 <?php echo $order; ?>">

			<?php if ($hero_layout != 3) { ?>
			<div class="danzerpress-image-wrap wow <?php echo $wowclass; ?>">
				<img src="<?php echo $section_image; ?>">
			</div>
			<?php } else {
				echo get_sub_field('custom_script');
			} ?>

		</div>
		<div id="" class="danzerpress-col-2 danzerpress-flex-row">
			<div class="danzerpress-align-self">
				<h2 class="danzerpress-title <?php echo $danzerpress_font_color; ?> wow fadeIn" style="text-align: left;"><?php echo $section_title; ?></h2>
				<p class="danzerpress-content <?php echo $danzerpress_font_color; ?> wow fadeIn" style="text-align: left;"><?php echo $section_description; ?></p>
				
				<?php 
				//Buttons
				include(locate_template('danzerpress-section-parts/content-button.php' )); 
				?> 

			</div>
		</div>
	</div>
</div>
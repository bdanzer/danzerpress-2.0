<div id="" class="danzerpress-one-third <?php echo $order; ?>">
	<div class="danzerpress-image-wrap wow <?php echo $wowclass; ?>">
		<img src="<?php echo $section_image; ?>">
	</div>
</div>
<div class="danzerpress-two-thirds danzerpress-align-center">
	<h2 class="danzerpress-title" style="margin:0px;text-align:left;"><?php echo $section_title; ?></h2>
	<div style="margin-bottom: 20px;">
		<p><?php echo $section_description; ?></p>
	</div>
	<?php 
	//Buttons
	include(locate_template('danzerpress-section-parts/content-button.php' )); 
	?> 
</div>
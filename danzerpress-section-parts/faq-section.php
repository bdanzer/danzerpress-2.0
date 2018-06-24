<?php
//Vars
$section_name = 'faq-section';

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	
	<div class="danzerpress-icon-img wow zoomIn">
		<img src="<?php echo $section_image; ?>">
	</div>
	<h2 class="danzerpress-title" style="margin-bottom: 40px;"><?php echo $section_title; ?></h2>
	<div class="danzerpress-flex-row">
		<div class="danzerpress-four-fifths danzerpress-col-center">

		 	<div class="danzerpress-flex-row">
		 		<?php 
				// check if the nested repeater field has rows of data
	        	if( have_rows('faq_block') ):

				 	echo '<div class="danzerpress-two-thirds danzerpress-col-center">';

				 	// loop through the rows of data
				    while ( have_rows('faq_block') ) : the_row();

						// vars
						$faqTitle = get_sub_field('faq_title');
						$faqContent = get_sub_field('faq_content');

						echo '
							<button class="danzerpress-accordion danzerpress-shadow-2 ' . $danzerpressColor . '"><h4>' . $faqTitle . '</h4></button>
							<div class="danzerpress-panel">
							  <div class="danzerpress-box ' . $danzerpressColor . '">' . $faqContent . '</div>
							</div>
						';

					endwhile;

					echo '</div>';

				endif; ?>
			</div>

		</div>
	</div>

<?php danzerpress_sections_footer(); ?>

<script>
var acc = document.getElementsByClassName("danzerpress-accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
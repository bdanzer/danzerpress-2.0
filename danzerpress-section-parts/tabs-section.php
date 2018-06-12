<?php
//Vars
$section_name = 'tabs-section';

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>


	<h2 class="danzerpress-title" style="margin-bottom: 40px;"><?php echo $section_title; ?></h2>
	<div class="danzerpress-flex-row">
		<div class="danzerpress-four-fifths danzerpress-col-center">

		 	<div class="danzerpress-flex-row">
		 		<?php 
		 			$x = 1;
				 	echo '<div class="danzerpress-two-thirds danzerpress-col-center">';
					 	echo '<div id="tabs" class="danzerpress-shadow-2">
								<ul class="danzerpress-flex-row">';
									// loop through the rows of data
								    while ( have_rows('tabs_title_block') ) : the_row();

										// vars
										$tabsTitle = get_sub_field('tabs_title');

										echo '
											<li><a href="#tab' . $x . '" title="">' . $tabsTitle . '</a></li>
										';

										$x++;

									endwhile;
								echo '</ul>
								<div id="tabs_container">
							';

					 	// loop through the rows of data
						$x = 1;
					    while ( have_rows('tabs_content_block') ) : the_row();

							// vars
							$tabsContent = get_sub_field('tabs_content');

							echo '
								

									<div id="tab' . $x . '">
									    <p>' . $tabsContent . '</p>
									</div>

								
							';

							$x = $x + 1;

						endwhile;

							echo '</div><!--End tabs container-->';
						echo '</div><!--End main-tabs container-->';
					echo '</div><!--End two-thirds container-->';

				?>
			</div>

		</div>
	</div>

<?php danzerpress_sections_footer(); ?>
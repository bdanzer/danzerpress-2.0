<?php
//Vars
$section_name = 'team-member-section';

//Header
include(locate_template('danzerpress-section-parts/content-header.php' )); ?>
	<h2 class="danzerpress-title" style="margin-bottom: 40px;"><?php echo $section_title; ?></h2>
	<div class="danzerpress-flex-row">
		<div class="danzerpress-four-fifths danzerpress-col-center" style="">

			<div class="danzerpress-flex-row">

				<?php 
				// check if the nested repeater field has rows of data
	        	if( have_rows('team_members') ):

				 	echo '<div class="danzerpress-flex-row ' . $section_name . '-wrap' . '">';

				 	// loop through the rows of data
				    while ( have_rows('team_members') ) : the_row();

						// vars
						$section_image = get_sub_field('section_image');
			        	$job_name = get_sub_field('job_name');
			        	$job_title = get_sub_field('job_title');
			        	$section_description = get_sub_field('section_description'); ?>

			        	<?php 
						if (get_sub_field('section_image')) {
							$section_new_image = get_sub_field('section_image');
						} else {
							$section_new_image = get_template_directory_uri() . '/danzerpress-images/no-image.png';
						}
						?>
						<div class="danzerpress-flex-row <?php echo $section_name . '-container'; ?>">
							<div class="danzerpress-one-third danzerpress-fix danzerpress-team-member-image danzerpress-zero">
								<img class="wow fadeInLeft" src="<?php echo $section_new_image; ?>">
							</div>

							<div class="danzerpress-two-thirds danzerpress-fix danzerpress-zero <?php echo $danzerpressColor; ?> wow fadeInUp">
								<div class="danzerpress-box">
									<h2 style="margin-bottom: 0px;"><?php echo $job_name ?></h2>
									<h4 style="margin-bottom: 20px;"><?php echo $job_title; ?></h4>
									<p><?php echo $section_description; ?></p>
									<p>
										<?php 
										// check if the nested repeater field has rows of data
							        	if( have_rows('social_media') ):

										 	echo '<div class="danzerpress-flex-row">';

										 	// loop through the rows of data
										    while ( have_rows('social_media') ) : the_row();

												// vars
												$socialLink = get_sub_field('social_media_link');
												$socialMediaNetwork = get_sub_field('social_media_network');

												echo '
													<a href="' . $socialLink . '"><i class="fa fa-' . $socialMediaNetwork . '"></i></a>
												';

											endwhile;

											echo '</div>';

										endif; ?>

									</p>
								</div>
							</div>
						</div>

					<?php endwhile;

					echo '</div>';

				endif; ?>
				
			</div>

			<?php 
			//Buttons
			include(locate_template('danzerpress-section-parts/content-button.php' )); 
			?>

		</div>
	</div>

<?php danzerpress_sections_footer(); ?>
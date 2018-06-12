<?php

//Vars
$section_custom_class = get_sub_field('custom_css_class');
$section_title = get_sub_field('section_title');
$section_description = get_sub_field('section_description');
$section_image = get_sub_field('section_image');
$section_icon = get_sub_field('section_icon');
$section_background = get_sub_field('section_background');
$section_background_color = get_sub_field('background_color');
$sections_with_background = array(
        'danzerpress-hero-section'
    );


//Setting the URL on certain conditions
if ( $section_background == true ) {
    $url = $section_background;
} elseif ($section_background_color == true) {
    $danzerpress_style = 'background:' . $section_background_color;
} elseif ( !$section_background ) {
    $url = 'https://unsplash.it/1920/1080/?random';
}

if (!$section_image && $section_name == 'danzerpress-image-section' || !$section_image && $section_name == 'danzerpress-hero-section' ) {
    $section_image = 'https://unsplash.it/1920/1080/?random';
}


//Image Side
$image_side = get_sub_field('image_side');

if ( $image_side == 'right' ) {
    $order = 'danzerpress-order-1';
    $wowclass = 'slideInRight';
} elseif ($image_side == 'left') {
    $order = 'danzerpress-order-0';
    $wowclass = 'slideInLeft';
} else {
    //Do Nothing
}

if ( $section_background && $section_name != 'half-and-half' || !$section_background && in_array($section_name, $sections_with_background) && $background_type != 'default' ) {
    $section_class = 'parallax-section parallax-window';
    $parallax_setup = 'data-parallax="scroll" data-image-src="' . $url . '"data-ios-fix="true"'; 
    $danzerpress_style = 'background:linear-gradient(rgba(0, 0, 0, 0.85), rgba(45, 45, 45, 0.29))';
} elseif ($section_name == 'half-and-half') {
    $section_class = 'parallax-section parallax-window';
    $parallax_setup = 'data-parallax="scroll" data-image-src="' . $url . '"data-ios-fix="true"'; 
    $danzerpress_style = 'background:transparent;';
} else {
    $parallax_setup = "";
    $danzerpress_style = "";
}


//Classes for section class
$danzerpress_section_class = array(
    'danzerpress-section',
    $section_class,
    $section_name,
    $section_custom_class
);

$danzerpress_section_id = 'section-' . $section_number;

?>

<div id="<?php echo $danzerpress_section_id; ?>" class="<?php danzerpressSectionClass($danzerpress_section_class); ?>" <?php echo $parallax_setup; ?> style="<?php echo $danzerpress_style; ?>">
<div class="danzerpress-wrap">

<?php 

$danzerpress_style = '';

?>


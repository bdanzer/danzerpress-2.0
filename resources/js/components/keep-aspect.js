if (jQuery) {
    jQuery(document).ready(function( $ ) {
        $('.danzerpress-image-section .danzerpress-image-wrap').each(function() {
            var imageWidth = $(this).children().prop('naturalWidth'),
                imageHeight = $(this).children().prop('naturalHeight'),
                aspectRatio = (imageHeight / imageWidth) * 100 + '%',
                my_css_class = { paddingTop : aspectRatio };

            $(this).css(my_css_class);
        });
    });
}
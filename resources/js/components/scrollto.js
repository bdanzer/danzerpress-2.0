class ScrollTo
{
    constructor() 
    {
        //Scrolling to anchor
        $(".danzerpress-hash").on('click', function(event) {
        
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();
        
                // Store hash
                var hash = this.hash;
                console.log(hash);
        
                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                scrollTop: $(hash).offset().top - $('header').outerHeight() + 5
                }, 1000, function(){
            
                // Add hash (#) to URL when done scrolling (default click behavior)
                
                });
            } // End if
        });
        
        $(window).on("load", function() {
            var urlHash = window.location.href.split("#")[1];
    
            if (urlHash && $('#' + urlHash).length ) {
                $('html, body').animate({
                        scrollTop: $('#' + urlHash).offset().top - $('header').outerHeight(true)
                    }, 400, function(){
                });
            }
        });
    }
}

new ScrollTo();
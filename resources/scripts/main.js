/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {

        new WOW().init();

        $(document).ready(function() {
          $('.drawer').drawer();
        });

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
                scrollTop: $(hash).offset().top + (-64)
              }, 1000, function(){
           
                // Add hash (#) to URL when done scrolling (default click behavior)
                
              });
            } // End if
        });

        $(window).on("load", function () {
          var urlHash = window.location.href.split("#")[1];

          if (urlHash &&  $('#' + urlHash).length ) {
            $('html, body').animate({
                scrollTop: $('#' + urlHash).offset().top + (-64)
            }, 1000, function(){


            });
          }

        });

        if (!$('.hide-header').length) {
          //Fix transparent menu when scrolling
          var a = $("html").offset().top;

          $(document).scroll(function(){
              if($(this).scrollTop() > a)
              {   
                $('header').addClass("danzerpress-non-trans").removeClass("danzerpress-trans");
                $('.danzerpress-emergency-header').addClass("danzerpress-no-display");
              } else {
                $('header').removeClass("danzerpress-non-trans").addClass("danzerpress-trans");
                $('.danzerpress-emergency-header').removeClass("danzerpress-no-display");
              }
          });
        }
        
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

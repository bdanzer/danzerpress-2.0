"use strict";

if (jQuery('.danzerpress-map-section')) {
  jQuery(document).ready(function () {
    var $ = jQuery;
    /*
    *  add_marker
    *
    *  This function will add a marker to the selected Google Map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$marker (jQuery element)
    *  @param	map (Google Map object)
    *  @return	n/a
    */

    function add_marker($marker, map) {
      // var
      var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng')); // create marker

      var marker = new google.maps.Marker({
        position: latlng,
        map: map
      }); // add to array

      map.markers.push(marker); // if marker contains HTML, add it to an infoWindow

      if ($marker.html()) {
        // create info window
        var infowindow = new google.maps.InfoWindow({
          content: $marker.html()
        }); // show info window when marker is clicked

        google.maps.event.addListener(marker, 'click', function () {
          infowindow.open(map, marker);
        });
      }
    }
    /*
    *  center_map
    *
    *  This function will center the map, showing all markers attached to this map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	map (Google Map object)
    *  @return	n/a
    */


    function center_map(map) {
      // vars
      var bounds = new google.maps.LatLngBounds(); // loop through all markers and create bounds

      $.each(map.markers, function (i, marker) {
        var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
        bounds.extend(latlng);
      }); // only 1 marker?

      if (map.markers.length === 1) {
        // set center of map
        map.setCenter(bounds.getCenter());
        map.setZoom(16);
      } else {
        // fit to bounds
        map.fitBounds(bounds);
      }
    }
    /*
    *  new_map
    *
    *  This function will render a Google Map onto the selected jQuery element
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$el (jQuery element)
    *  @return	n/a
    */


    function new_map($el) {
      // var
      var $markers = $el.find('.marker'); // vars

      var args = {
        zoom: 16,
        center: new google.maps.LatLng(0, 0),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }; // create map	        	

      var map = new google.maps.Map($el[0], args); // add a markers reference

      map.markers = []; // add markers

      $markers.each(function () {
        add_marker($(this), map);
      }); // center map

      center_map(map); // return

      return map;
    }
    /*
    *  document ready
    *
    *  This function will render each map when the document is ready (page has loaded)
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	5.0.0
    *
    *  @param	n/a
    *  @return	n/a
    */
    // global var


    var map = null;
    $(document).ready(function () {
      $('.acf-map').each(function () {
        // create map
        map = new_map($(this));
      });
    });
  });
}
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var InfiniteScroll =
/*#__PURE__*/
function () {
  function InfiniteScroll(archive) {
    _classCallCheck(this, InfiniteScroll);

    this.notLoading = true;
    this.perPage = document.getElementById('infinite-row').getAttribute('data-post-per');
    this.page = document.getElementById('infinite-row').getAttribute('data-page');
    this.columns = document.getElementById('infinite-row').getAttribute('data-columns');
    this.template = document.getElementById('infinite-row').getAttribute('data-template');
    this.stop = false;
    this.spinner = jQuery('#spinner');
    this.archive = archive;
    console.log(this.template);
  }

  _createClass(InfiniteScroll, [{
    key: "calculateScroll",
    value: function calculateScroll() {
      var _this = this;

      window.addEventListener('scroll', function () {
        if (_this.stop) {
          return;
        }

        var y = window.pageYOffset;
        var archiveHeight = archive.offsetHeight * .80;

        if (y > archiveHeight && _this.notLoading) {
          _this.spinner.toggleClass('danzerpress-no-display');

          _this.getPosts(_this.archive);
        }
      });
    }
  }, {
    key: "getPosts",
    value: function getPosts(obj) {
      var _this2 = this;

      this.notLoading = false;
      var $ = jQuery;
      $.ajax({
        type: 'POST',
        url: dp.home_url + '/wp/wp-admin/admin-ajax.php',
        data: {
          action: 'infinite_scroll',
          data: {
            'columns': this.columns,
            'per_page': this.perPage,
            'page': this.page,
            'template': this.template
          }
        }
      }).done(function (response) {
        if (false !== response.success) {
          _this2.page++;

          _this2.spinner.toggleClass('danzerpress-no-display');

          obj.insertAdjacentHTML('beforeend', response.data);
          _this2.notLoading = true;
        } else {
          _this2.fail(obj);
        }
      }).fail(function () {
        _this2.fail(obj);
      });
    }
  }, {
    key: "fail",
    value: function fail(obj) {
      this.stop = true;
      this.spinner.toggleClass('danzerpress-no-display');
      obj.insertAdjacentHTML('beforeend', '<div class="danzerpress-col-1"><div class="infinite-no-posts danzerpress-accent-border">No More Posts To Show</div></div>');
    }
  }]);

  return InfiniteScroll;
}();

var archive = document.getElementById('infinite-row');

if (archive) {
  var infinite = new InfiniteScroll(archive);
  infinite.calculateScroll();
}
"use strict";

if (jQuery) {
  jQuery(document).ready(function ($) {
    $('.danzerpress-image-section .danzerpress-image-wrap').each(function () {
      var imageWidth = $(this).children().prop('naturalWidth'),
          imageHeight = $(this).children().prop('naturalHeight'),
          aspectRatio = imageHeight / imageWidth * 100 + '%',
          my_css_class = {
        paddingTop: aspectRatio
      };
      $(this).css(my_css_class);
    });
  });
}
"use strict";
//# sourceMappingURL=babel.js.map

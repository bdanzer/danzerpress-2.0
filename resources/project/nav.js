var $ = jQuery;

document.addEventListener('DOMContentLoaded', function() {
    class NavLevel {
        constructor() 
        {
            this.counter = -1;
            this.dropDowns = document.querySelectorAll('.drawer-dropdown-menu.dropdown-children');

            console.log(this.dropDowns);

            var _this = this;

            $('.fa-caret-down').on("click", function() {
                $(this).stop().toggle();
                $(this).next().stop().toggle();
                $(this).next().next().stop().fadeToggle();
            });

            $('.fa-caret-up').on("click", function() {
                $(this).stop().toggle();
                $(this).prev().stop().toggle();
                $(this).next().stop().fadeToggle();
            });

            $('ul li .fa-caret-right').on("click", function() {
                _this.counter = _this.counter + 1;
                _this.dropDowns[_this.counter].style.display = 'block';

                $(this).parent().addClass('li-open');

                var isUlOpen = $('.ul-open');

                if (isUlOpen) {
                    isUlOpen.removeClass('ul-open');
                }

                $(this).next().addClass('ul-open');
            });

            $('.drawer-dropdown-menu.dropdown-children .fa-arrow-left').on("click", function() {
                _this.dropDowns[_this.counter].style.display = 'none';
                _this.counter = _this.counter - 1;
            });
        }

        listenMenuButtons() 
        {
            
        }
    }

    new NavLevel;
});
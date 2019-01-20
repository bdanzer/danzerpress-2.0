var $ = jQuery;

document.addEventListener('DOMContentLoaded', function() {
    class NavLevel {
        constructor() 
        {
            this.open = false;
            this.counter = -1;
            this.dropDowns = document.querySelectorAll('.drawer-dropdown-menu.dropdown-children');
            this.caretUp = $('.fa-caret-up');
            this.caretDown = $('.fa-caret-down');

            this.init();
        }

        init() 
        {
            this.caretDown.on("click", (event) => {
                var caretD = $(event.target),
                    caretUp = caretD.next(),
                    ulMenu = caretD.next().next(),
                    parent = caretD.parent();

                if ($('.parent-li-open').length) {
                    this.cleanMenu();
                }

                parent.addClass('parent-li-open');

                caretD.stop().toggleClass('danzerpress-flex');
                caretUp.stop().toggleClass('danzerpress-flex');
                ulMenu.stop().toggle().toggleClass('ul-open');
            });

            this.caretUp.on("click", () => {
                this.cleanMenu();
            });

            $('ul li .fa-caret-right').on("click", (item) => {
                var caretR = $(item.target);

                this.counter = this.counter + 1;
                this.dropDowns[this.counter].style.display = 'block';

                caretR.parent().addClass('li-open');

                var isUlOpen = $('.ul-open');

                if (isUlOpen) {
                    isUlOpen.removeClass('ul-open');
                }

                caretR.next().addClass('ul-open');
            });

            $('.drawer-dropdown-menu.dropdown-children .fa-chevron-left').on("click", () => {
                this.dropDowns[this.counter].style.display = 'none';
                this.counter = this.counter - 1;
            });
        }

        openMenu() 
        {

        }

        closeMenu() 
        {

        }

        cleanMenu() 
        {
            this.counter = -1;

            $('.parent-li-open .li-open')
                .removeClass('li-open');

            $('.parent-li-open .fa-caret-up')
                .toggleClass('danzerpress-flex');
            
            $('.parent-li-open .fa-caret-down')
                .toggleClass('danzerpress-flex');
            
            $('.parent-li-open')
                .removeClass('parent-li-open')
                .find('ul')
                .removeClass('ul-open')
                .css({'display':'none'});
        }
    }

    new NavLevel;
});
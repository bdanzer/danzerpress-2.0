var $ = jQuery;

document.addEventListener('DOMContentLoaded', function() {
    class NavLevel {
        constructor() 
        {
            this.caretUp = $('.fa-caret-up');
            this.caretDown = $('.fa-caret-down');
            this.backButton = $('.drawer-dropdown-menu.dropdown-children .fa-chevron-left');

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
                let caretR = $(item.target),
                    nextUl = caretR.next();

                caretR.parent().addClass('li-open');

                let currentUl = $('.ul-open');

                if (currentUl) {
                    currentUl.removeClass('ul-open');
                }

                nextUl.addClass('ul-open').toggle();
            });

            this.backButton.on("click", (item) => {
                let backButton = $(item.target),
                    currentLi = $('.ul-open .li-open'),
                    currentUl = backButton.closest('ul');

                    currentLi.removeClass('li-open');

                    currentUl
                        .removeClass('ul-open')
                        .toggle()
                        .parent()
                        .closest('ul')
                        .addClass('ul-open');
                        
            });
        }

        cleanMenu() 
        {
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
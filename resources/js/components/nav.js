class NavLevel {
    constructor() 
    {
        this.caretUp = $('.fa-caret-up');
        this.caretDown = $('.fa-caret-down');
        this.backButton = $('.drawer-dropdown-menu.dropdown-children .fa-chevron-left');

        this.init();
        this.headerScroll();
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
                nextUl = caretR.next(),
                currentLi = $('.ul-open .li-open');

            /**
             * clean This Repeated
             */
            currentLi.removeClass('li-open');

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

            /**
             * Clean This Repeated
             */
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

    headerScroll() 
    {
        if (!$('.danzerpress-non-trans').length) {
            //Fix transparent menu when scrolling
            var a = $("html").offset().top;
        
            var checkJs = $('.dp-no-js');
            if (checkJs) {
                checkJs.removeClass('dp-no-js').addClass('dp-js');
            }
        
            $(document).scroll(function(){
                if($(this).scrollTop() > a)
                {  
                $('body').addClass("danzerpress-non-trans").removeClass("danzerpress-trans");
                $('.danzerpress-emergency-header').addClass("danzerpress-no-display");
                } else {
                $('body').removeClass("danzerpress-non-trans").addClass("danzerpress-trans");
                $('.danzerpress-emergency-header').removeClass("danzerpress-no-display");
                }
            });
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    new NavLevel;
});
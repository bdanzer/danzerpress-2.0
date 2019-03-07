class Main 
{
    constructor() 
    {
        this.init();
    }

    init() 
    {
        AOS.init({
            useClassNames: true,
            initClassName: false,
            animatedClassName: 'animated',
            offset: -50,
        });
        
        $(document).ready(function() {
            $('.drawer').drawer();
        });
    }
}

new Main();
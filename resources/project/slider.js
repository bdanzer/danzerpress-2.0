class Slider {
    constructor() 
    {
        this.sliderWrap = document.querySelector('.danzerpress-slider-wrap');
        this.slider = document.querySelector('.danzerpress-slider');
        this.createPagination();
    }

    createPagination()
    {
        let sliderPagination = `
            <div class="danzerpress-slider-pagination">
                <ul>
                </ul>
            </div>
        `;
        let doc = new DOMParser().parseFromString(sliderPagination, 'text/html').body.firstChild;
        for (let i = 0; i < this.slider.children.length; i++) {
            let button = document.createElement('li');
            doc.children[0].append(button);
            button.addEventListener('click', (e) => {
                let activeDiv = document.querySelectorAll('.danzerpress-slider div.active');
                let activeLi = document.querySelectorAll('.danzerpress-slider-pagination ul li');

                this.setActiveStuff(activeDiv);
                this.setActiveStuff(activeLi);
                this.slider.children[i].classList.add('active');
                e.target.classList.add('active');
            });
            if (i == 0) {
                button.classList.add('active');
                this.slider.children[i].classList.add('active');
            }
        }
        this.sliderWrap.append(doc);
    }

    setActiveStuff(thing) 
    {
        if (thing) {
            thing.forEach((div) => {
                div.classList.remove('active');
            });
        }
    }
}
new Slider();
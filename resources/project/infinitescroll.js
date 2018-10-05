class InfiniteScroll {
    constructor() {
        this.notLoading = true;
        this.perPage = document.getElementById('infinite-row').getAttribute('data-post-per');
        this.page = document.getElementById('infinite-row').getAttribute('data-page');
        this.stop = false;
        this.spinner = jQuery('#spinner');
    }
    
    calculateScroll() {
        window.addEventListener('scroll', () => {
            if (this.stop) {
                return;
            }

            var y = window.pageYOffset;
            var archive = document.querySelector('.archive .danzerpress-two-thirds .danzerpress-flex-row');

            if (y > archive.offsetHeight && this.notLoading) {
                this.spinner.toggleClass('danzerpress-no-display');
                this.getPosts(archive);
            }
        });
    }
    
    getPosts(obj) {
        this.notLoading = false;
        var $ = jQuery;
        var $wpURL="/wp-json/wp/v2/posts?";
    
        $wpURL = $wpURL + "per_page="+ this.perPage +"&page="+ this.page;
    
        $.ajax({
            type: 'GET',
            url: $wpURL,
            action: 'createHTML'
         }).done((response) => {
            response.forEach(post => {
                obj.insertAdjacentHTML('beforeend', this.generateHtml(post))
            });
            this.notLoading = true;
            this.page++;
            this.spinner.toggleClass('danzerpress-no-display');
         }).fail(() => {
            this.stop = true;
            this.spinner.toggleClass('danzerpress-no-display');
            obj.insertAdjacentHTML('beforeend', '<div class="danzerpress-col-1"><div class="danzerpress-box danzerpress-white">No More Posts To Show</div></div>')
         });
    }

    generateHtml(post) {
        var html = `<article class="danzerpress-col-2 danzerpress-flex-column wow fadeIn">
            <div class="image-wrap">
                <a href="${post.link}">
                    ${post.thumbnail}
                </a>
            </div>
            <div class="danzerpress-box danzerpress-white">
                <header>
                    <h2 class="entry-title"><a class="danzerpress-accent-color" href="https://dev1.danzerpress.com/quia-adipisci-ea-sint-corporis-eaque/">${post.title.rendered}</a></h2>
                </header>
                <div class="entry-summary">
                    ${post.post_excerpt}
                </div>
            </div>
            <a class="danzerpress-button-modern" href="${post.link}">Read More</a>
        </article>`;

        return html;
    }
}
var infinite = new InfiniteScroll();
infinite.calculateScroll();
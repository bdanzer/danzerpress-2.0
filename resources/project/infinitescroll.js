class InfiniteScroll {
    constructor() {
        this.notLoading = true;
        this.perPage = document.getElementById('infinite-row').getAttribute('data-post-per');
        this.page = document.getElementById('infinite-row').getAttribute('data-page');
        this.columns = document.getElementById('infinite-row').getAttribute('data-columns');
        this.stop = false;
        this.spinner = jQuery('#spinner');
    }
    
    calculateScroll() {
        window.addEventListener('scroll', () => {
            if (this.stop) {
                return;
            }

            var y = window.pageYOffset;
            var archive = document.getElementById('infinite-row');
            var archiveHeight = (archive.offsetHeight * .90);

            if (y > archiveHeight && this.notLoading) {
                this.spinner.toggleClass('danzerpress-no-display');
                this.getPosts(archive);
            }
        });
    }
    
    getPosts(obj) {
        this.notLoading = false;
        var $ = jQuery;
    
        $.ajax({
            type: 'POST',
            url: 'wp/wp-admin/admin-ajax.php',
            data: {
                action: 'infinite_scroll', 
                data: {
                    'columns': this.columns,
                    'per_page': this.perPage,
                    'page': this.page
                }
            }
         }).done((response) => {
            if (false !== response.success) {
                this.page++;
                this.spinner.toggleClass('danzerpress-no-display');
                obj.insertAdjacentHTML('beforeend', response.data);
                this.notLoading = true;
            } else {
                this.fail(obj);
            }
            
         }).fail(() => {
            this.fail(obj);
         });
    }

    fail(obj) {
        this.stop = true;
        this.spinner.toggleClass('danzerpress-no-display');
        obj.insertAdjacentHTML('beforeend', '<div class="danzerpress-col-1"><div class="danzerpress-box danzerpress-white">No More Posts To Show</div></div>')
    }
}
var infinite = new InfiniteScroll();
infinite.calculateScroll();
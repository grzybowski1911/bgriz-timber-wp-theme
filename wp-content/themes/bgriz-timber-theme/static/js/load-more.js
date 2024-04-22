jQuery(document).ready(function($) {
    var page = 1;

    $('#load-more-posts').on('click', function(e) {

        console.log('clicked');

        e.preventDefault();
        page++;

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more',
                post_type: 'project', // replace with your actual post type
                page: page
            },
            success: function(response) {
                console.log('success');
                if (response) {
                    console.log('response success');
                    $('#post-grid-container').append(response);
                } else {
                    console.log('else');
                    $('#load-more-posts').hide(); // hide button if no more posts to load
                }
            }
        });
    });
});

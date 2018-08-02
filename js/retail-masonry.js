jQuery(document).ready( function($) {
    $('#grid-loop.masonry').imagesLoaded(function () {
        $('#grid-loop.masonry').masonry({
            itemSelector: 'article',
            gutter: 0,
            transitionDuration: 0,
        }).masonry('reloadItems');
    });
});
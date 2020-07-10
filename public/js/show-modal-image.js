$(document).on("click", ".document-td", function () {
    var image_src = $(this).data('image-src');
    $('#document-image').attr('src', image_src);
});

$(document).ready(function() {

    const $valueSpan = $('.valueRange');
    const $value = $('#priceRange');
    $valueSpan.html($value.val());
    $value.on('input change', () => {

        $valueSpan.html($value.val());
    });
});

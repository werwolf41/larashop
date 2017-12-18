$('body').on('change', '.perpage, form.query input[type=text]', function () {
    $(this).parents('form.query').submit();
});


$(document).ready(function () {
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
    });
});

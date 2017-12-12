$('body').on('change', '.perpage', function () {
    $(this).parents('form.query').submit();
});
$('body').on('keyup', 'form.query input[type=text]', function () {
    var val = $(this).val();
    if(val.length >3){
        $(this).parents('form.query').submit();
    }
});

$(document).ready(function () {
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
    });
});

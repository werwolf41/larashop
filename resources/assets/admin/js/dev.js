/*change search input*/
$('form.query input, form.query select').on('change', function () {
    $(this).parents('form').submit();
});

/*input search text*/
$('form.query input').on('keyup', function () {
    var val = $(this).val();
    if (val.length > 2) {
        $(this).parents('form').submit();
    }
});

/*pagination click*/
$('.pull-right').on('click', '.pagination a', function (e) {
    e.preventDefault();
    openPage($(this).attr('href'));
});

/*delete element*/
$('body').on('submit', 'form.delete', function (e) {
    e.preventDefault();
    openPage($(this).attr('action'));
});

/*click browser back button*/
$(window).bind('popstate', function (event) {
    openPage(history.state.uri);
});

/*send ajax query*/
function openPage(uri) {
    uri += getSort();
    history.pushState({'url': uri}, null, uri);
    $.ajax({
        type: "get",
        url: uri,
        cache: false,
        success: function (data) {
            createTable(data);
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
            });
        }
    });
}

/*get sort option in uri*/
function getSort() {
    var search = window.location.search;
    var sort = '';
    if(search.length){
        res = search.slice(1).split('&');
        for(var i = 0; i<res.length; i++){
            var arr = res[i].split('=');
            if(arr[0] == 'sort') {
                sort +='&sort=' + arr[1];
            }
            if(arr[0] == 'order') {
                sort +='&order=' + arr[1];
            }
        }
    }
    return sort;
}

/*confirm form for delete item*/
$(document).ready(function () {
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
    });
});
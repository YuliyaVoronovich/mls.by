$(document).ready(function ($) {

    $(".tableSticky").stickyTableHeaders();

    //поиск
    $('.search').on('change', function (e) {

        e.preventDefault();
        var data = $('#user_search_form').serializeArray();
        $.ajax({
            url: $('#user_search_form').attr('action'),
            data: data,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            datatype: 'html',
            success: function (html) {
                // alert(html);
                $('.table tbody').html(html);

            },
            error: function () {

            }
        });

    });

    ymaps.ready(init);
    var map, placemark = null;

    function init() {
        map = new ymaps.Map('myMap', {
            center: [53.902257, 27.56164],
            zoom: 11,
            behaviors: ['default', 'scrollZoom']
        });
        map.controls
        // Кнопка изменения масштаба
            .add('zoomControl')
        /*// Список типов карты
         .add('typeSelector')
         // Стандартный набор кнопок
         .add('mapTools');*/

    }
});

var part = 1; // нулевая  уже выведена
$(document).ready(function () {

    $(window).on('scroll', function () {
        if ($(document).height() - $(window).height() <= $(window).scrollTop()) {

            //  dost = $(".accessChoosed").html();
            loadnextNew(part);
            part++;

        }
    });
});

//подгрузка
function loadnextNew(i) {

    var data = $('#user_search_form').serializeArray();

    if (!isNull(data)) {
        $.ajax({
            url: $('#user_search_form').attr('action'),
            data: $('#user_search_form').serialize() + "&i=" + i,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            datatype: 'html',
            success: function (html) {
                // alert(html);
                $('#scroll').replaceWith(html);

            },
            error: function () {

            }
        });
    }
}

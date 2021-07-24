$(function () {

    // $('select[multiple]').select2(); // ne fonctionne pas avec la fonction random

    var lockRandom = function (id) {
        id.on('click', function () {
            id.toggleClass('btn-success');
            id.toggleClass('btn-primary');
            if (id.hasClass('btn-success')) {
                id.html('<i class="fas fa-lock"></i>');
            }
            else {
                id.html('<i class="fas fa-lock-open"></i>');
            }
        });
    };

    lockRandom($('#lock_age'));
    lockRandom($('#lock_sex'));

    $('#random_all').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'all'}, function (data) {
            if ($('#lock_age').hasClass('btn-primary')) $('#character_age').val(data.age);
            if ($('#lock_sex').hasClass('btn-primary')) $('#character_sex').val(data.sex);
        });
    });

    $('#random_age').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'age'}, function (data) {
            console.log(data)
            $('#character_age').val(data.age); //.change(); (peut être que ça ne fonctionnera plus avec select 2)
        });
    });

    $('#random_sex').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'sex'}, function (data) {
            $('#character_sex').val(data.sex);
        });
    });

    // Search API
    var $search = $('#search');
    var cache = {};
    $('#refresh').each(function () {
        var $div = $(this);
        var url = $div.data('api');

        var searchCharacter = function (search) {
            if (cache.hasOwnProperty(search)) {
                $div.html(cache[search]);
            } else {
                $.get(url, {search: search}, function (html) {
                    cache[search] = html;
                    $div.html(html);
                });
            }
        };

        $search.on('keyup', function () {
            searchCharacter($search.val());
        });
        searchCharacter('');

        // Exemple de pagination en AJAX
        $div.on('click', 'ul.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function (html) {
                $div.html(html);
            });

        });

    });

})
;
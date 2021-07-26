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

    // List of all character parameters which can be randomized
    const values = ['age', 'sex', 'default', 'ethnic', 'morphologies', 'occupation', 'job', 'character', 'alignement', 'persona', 'manias', 'distinctives', 'culturals', 'liabilities', 'universe', 'size', 'stature']

    values.forEach(value => {
        lockRandom($('#lock_' + value));

        $('#random_' + value).on('click', function () {
            var url = $(this).data('api');
            $.get(url, {subject: value}, function (data) {
                console.log(data)
                $('#character_' + value).val(data[value]);
            });
        });
    })

    $('#random_all').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'all'}, function (data) {
            values.forEach(value => {
                if ($('#lock_' + value).hasClass('btn-primary')) $('#character_' + value).val(data[value]);
            })
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
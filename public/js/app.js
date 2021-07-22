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
    lockRandom($('#lock_size'));
    lockRandom($('#lock_weight'));
    lockRandom($('#lock_build'));
    lockRandom($('#lock_personality'));
    lockRandom($('#lock_particularities'));
    lockRandom($('#lock_liabilities'));
    lockRandom($('#lock_sex'));
    lockRandom($('#lock_ethnic'));

    $('#random_all').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'all'}, function (data) {
            if ($('#lock_age').hasClass('btn-primary')) $('#character_age').val(data.age);
            if ($('#lock_sex').hasClass('btn-primary')) $('#character_sex').val(data.sex);
            if ($('#lock_size').hasClass('btn-primary')) $('#character_size').val(data.size);
            if ($('#lock_weight').hasClass('btn-primary')) $('#character_weight').val(data.weight);
            if ($('#lock_build').hasClass('btn-primary')) $('#character_build').val(data.build);
            if ($('#lock_personality').hasClass('btn-primary')) $('#character_personality').val(data.personality);
            if ($('#lock_particularities').hasClass('btn-primary')) $('#character_particularities').val(data.particularities);
            if ($('#lock_liabilities').hasClass('btn-primary')) $('#character_liabilities').val(data.liabilities);
            if ($('#lock_ethnic').hasClass('btn-primary')) $('#character_ethnic').val(data.ethnic);
        });
    });

    $('#random_age').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'age'}, function (data) {
            $('#character_age').val(data.age); //.change(); (peut être que ça ne fonctionnera plus avec select 2)
        });
    });

    $('#random_size').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'size'}, function (data) {
            $('#character_size').val(data.size);
        });
    });

    $('#random_weight').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'weight'}, function (data) {
            $('#character_weight').val(data.weight);
        });
    });

    $('#random_build').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'build'}, function (data) {
            $('#character_build').val(data.build);
        });
    });

    $('#random_personality').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'personality'}, function (data) {
            $('#character_personality').val(data.personality);
        });
    });

    $('#random_particularities').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'particularity'}, function (data) {
            $('#character_particularities').val(data.particularities);
        });
    });

    $('#random_liabilities').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'liability'}, function (data) {
            $('#character_liabilities').val(data.particularities);
        });
    });

    $('#random_sex').on('click', function () {
        var url = $(this).data('api');
        $.get(url, {subject: 'sex'}, function (data) {
            $('#character_sex').val(data.sex);
        });
    });

    //$('#random_ethnic').on('click', function () {
    //    var url = $(this).data('api');
    //    $.get(url, {subject: 'ethnic'}, function (data) {
    //       $('#character_ethnic').val(data.ethnic);
    //    });
    //});

    $('#random_ethnic').on('click', function () {

        var table = []; // on déclare un tableau
        $('#character_ethnic').children('option').each(function () {
            var option = {}; // on déclare un objet
            option.id = $(this).data('id');
            option.ratio = $(this).data('ratio');
            table.push(option); // hop on glisse l'objet dans le tableau
        });

        $('#character_ethnic').val(data.ethnic);

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
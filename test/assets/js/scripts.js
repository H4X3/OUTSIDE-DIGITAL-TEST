$(document).ready(function () {


    /**
     * defaults Fancybox
     */
    $.fancybox.defaults.animationDuration = 366;
    $.fancybox.defaults.closeExisting = true;
    $.fancybox.defaults.touch = false;
    $.fancybox.defaults.btnTpl.smallBtn = '<a class="cross" data-fancybox-close ></a>';
    $.fancybox.defaults.autoFocus = false;
    $.fancybox.defaults.backFocus = true;
    $.fancybox.defaults.trapFocus = true;
    $.fancybox.defaults.clickContent = false;
    $.fancybox.defaults.clickSlide = false;
    $.fancybox.defaults.clickOutside = false;
    $.fancybox.defaults.dblclickContent = false;
    $.fancybox.defaults.dblclickSlide = false;
    $.fancybox.defaults.dblclickOutside = false;


    /* inputs mask */
    $('input[mask="phone"]').inputmask(
        {
            mask: '+7(999)999-99-99',
            "clearIncomplete": true
        }
    );

    /**
     * tabs
     */

    var curTab = GetURLParameter('tab');

    $(document).on("change", ".site-tabs input", function () {
        var
            el = $(this),
            elID = el.attr('id'),
            divContent = $('div[data-id=' + elID + ']'),
            closestDivs = $("." + divContent.attr('class'))
        ;
        closestDivs.not(divContent).slideUp('easing');
        divContent.slideDown('easing');
        updateURL('tab', elID);
    });

    $(`input[name="tab"][data-id="${curTab}"]`).trigger('change').trigger('click');

    function updateURL (key, value) 
    {
        if (history.pushState) {
            var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            var newUrl = baseUrl + `?${key}=${value}`;
            history.pushState(null, null, newUrl);
        }
        else {
            console.warn('History API не поддерживается');
        }
    }

    function GetURLParameter (sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }

    /**
     * modals
     */
    $(document).on("click", ".js-modal", function (e) {
        var modal = $(this).attr('data-id');

        $.fancybox.open({
            src: `#${modal}`,
            type: 'inline',
            touch: false,
            opts: {
                baseTpl:
                    '<div class="fancybox-container" role="dialog" tabindex="-1">' +
                    '<div class="fancybox-bg fancybox-bg--modals"></div>' +
                    '<div class="fancybox-inner">' +
                    '<div class="fancybox-stage"></div>' +
                    '</div>' +
                    '</div>',
            }
        });

    });

    $(document).on("submit", "form[name=createAuthor]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            data: { action: 'set', data: data, table: 'authors' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=editAuthor]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            async: false,
            data: { action: 'edit', data: data, table: 'authors' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=createUser]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            data: { action: 'set', data: data, table: 'user' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=editUser]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            async: false,
            data: { action: 'edit', data: data, table: 'user' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=createBook]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();
        var checks = $(this).find('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get();

        var author_id = { 'name': 'author_id', 'value': checks };

        data.push(author_id);

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            data: { action: 'set', data: data, table: 'book' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=editBook]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();
        var checks = $(this).find('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get();

        var author_id = { 'name': 'author_id', 'value': checks };

        data.push(author_id);
        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            async: false,
            data: { action: 'edit', data: data, table: 'book' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=createReservation]", function (e) {
        e.preventDefault();
        var _form = $(this),
            data = $(this).serializeArray()
        ;

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            data: { action: 'set', data: data, table: 'reservation' },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status == 'error') {
                    _form.find('.modal-error').text(res.message);
                } else {
                    location.reload();
                }
            }
        });

    });

    $(document).on("submit", "form[name=editReservation]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            async: false,
            data: { action: 'edit', data: data, table: 'reservation' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=createGenre]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            data: { action: 'set', data: data, table: 'genre' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("submit", "form[name=editGenre]", function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            async: false,
            data: { action: 'edit', data: data, table: 'genre' },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("click", ".js-delete", function (e) {
        e.preventDefault();
        var
            el = $(this),
            id = el.closest('.items-row').attr('data-id'),
            table = el.attr('data-id')
            ;

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            data: { action: 'delete', id: id, table: table },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(document).on("click", ".js-edit", function (e) {
        var
            el = $(this),
            id = el.closest('.items-row').attr('data-id'),
            _table = el.attr('data-id'),
            _modal = el.attr('data-modal')
        ;

        $.ajax({
            method: "POST",
            url: '/ajax/ajax.php',
            data: { action: 'get', id: id, table: _table },
            success: function (response) {
                var res = JSON.parse(response);
                if (_table == 'user') {
                    $(`form[name=${_modal}] input[name="id"]`).val(res.id);
                    $(`form[name=${_modal}] input[name="fio"]`).val(res.fio);
                    $(`form[name=${_modal}] input[name="phone"]`).val(res.phone);
                    $(`form[name=${_modal}] input[name="address"]`).val(res.address);
                } else if (_table == 'authors') {
                    $(`form[name=${_modal}] input[name="id"]`).val(res.id);
                    $(`form[name=${_modal}] input[name="fio"]`).val(res.fio);
                } else if (_table == 'book') {
                    $(`form[name=${_modal}] input[name="id"]`).val(res.isbn);
                    $(`form[name=${_modal}] input[name="name"]`).val(res.name);
                    $(`form[name=${_modal}] input[name="date"]`).val(res.year);
                    $(`form[name=${_modal}] input[name="count_pages"]`).val(res.count_pages);
                    $(`form[name=${_modal}] input[name="count"]`).val(res.count);
                    $(`form[name=${_modal}] input[type="checkbox"]`).prop('checked', false);
                    $.each(res.authors, function (index, value) {
                        $(`form[name=${_modal}] input[type="checkbox"][id="${index}"]`).prop('checked', true);
                    });
                    $(`form[name=${_modal}] select[name="genre_id"] option[value="${res.genre_id}"]`).prop('selected', true);

                } else if (_table == 'reservation') {
                    $(`form[name=${_modal}] input[name="id"]`).val(res.res_id);
                    $(`form[name=${_modal}] select[name="user_id"] option[value="${res.user_id}"]`).prop('selected', true);
                    $(`form[name=${_modal}] select[name="isbn_id"] option[value="${res.isbn_id}"]`).prop('selected', true);
                    $(`form[name=${_modal}] input[name="date_issue"]`).val(res.date_issue);
                    $(`form[name=${_modal}] input[name="date_return"]`).val(res.date_return);
                } else if (_table == 'genre') {
                    $(`form[name=${_modal}] input[name="id"]`).val(res.id);
                    $(`form[name=${_modal}] input[name="name"]`).val(res.name);
                }

                $.fancybox.open({
                    src: `#${_modal}`,
                    type: 'inline',
                    touch: false,
                    opts: {
                        baseTpl:
                            '<div class="fancybox-container" role="dialog" tabindex="-1">' +
                            '<div class="fancybox-bg fancybox-bg--modals"></div>' +
                            '<div class="fancybox-inner">' +
                            '<div class="fancybox-stage"></div>' +
                            '</div>' +
                            '</div>',
                    }
                });
            }
        });

    });

});
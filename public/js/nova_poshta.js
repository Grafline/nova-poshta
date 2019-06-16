$(document).ready(function () {

    $('.basket select[name=delivery]').change(function () {
        var delivery_np = $('.nova_poshta').data('dnp');
        if ($(this).val() == delivery_np) {
            $('.nova_poshta').show();
        } else {
            $('.nova_poshta').hide();
        }
        return false;
    });

    $(document).on("click", ".nova_poshta #nova_poshta_city .input-group", function () {
        $(this).next('ul.list').show();
    });

    $(document).on("click", ".nova_poshta #nova_poshta_warehouse .input-group", function () {
        $(this).next('ul.list').show();
    });

    $(document).on("click", ".nova_poshta #nova_poshta_city ul li", function () {
        var ref = $(this).data('ref');
        var val = $(this).html();
        var token = $('input[name=_token]').val();
        $('.nova_poshta #np_city').val(val);
        $('.nova_poshta #np_city_ref').val(ref);
        $(this).parent().hide();

        $('.nova_poshta #nova_poshta_warehouse').show();
        $.post('/ajax_get_warehouses', {'_token': token, 'ref': ref}, function (data) {
            if (data) {
                $('.nova_poshta #np_warehouse').val(data.first);
                $('.nova_poshta #nova_poshta_warehouse ul.list').html(data.options);
            }
        }, 'json');
    });


    $(document).on("input", ".nova_poshta #np_city", function () {

        var input = $(this);
        var key = input.val();
        if (key.length > 2) {

            var token = $('input[name=_token]').val();

            $.post('/ajax_get_cites', {'_token': token, 'key': key}, function (data) {
                if (data) {
                    input.val(data.first);
                    $('.nova_poshta #nova_poshta_city ul.list').html(data.options);
                }
            }, 'json');
        }
    });

    $(document).on("click", ".nova_poshta #nova_poshta_warehouse ul li", function () {
        var ref = $(this).data('ref');
        var val = $(this).html();

        $('.nova_poshta #np_warehouse').val(val);
        $('.nova_poshta #np_warehouse_ref').val(ref);
        $(this).parent().hide();
    });

});
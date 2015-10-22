$().ready(function () {

    bootbox.setDefaults({
        locale: "pl",
    });


    // dodaje confirm dla linków usuwajacych produkty z koszyka
    $('table a.remove').on('click', function (event) {

        var url = $(this).attr('href');
        event.preventDefault();
        bootbox.confirm("Czy napewno chcesz usunąć ten produkt?", function (result) {
            if (result) {
                window.location = url;
            }
        });
    });

    $('a.vote-up, a.vote-down').click(function () {

        var $link = $(this),
                url = $link.attr('href');

        $.getJSON(
                url,
                function (response) {
                    if (response.success) {
                        $link.prev().html(response.nbVotes);
                    } else {
                        bootbox.alert(response.message);
                    }
                }
        );

        return false;
    });
    var $quantity = $('.quantity-step').val();
    var $price = $('.price').data('price') * 1;
    var $netto_value = $price * $quantity ;
    var $vat = $('div.vat_type').data('vat') * 1;
    $('.total_sum > .price_value > span').html($netto_value);
    
    $('#vatvalue').html(($netto_value * (1 + ($vat / 100)))-$netto_value);
});

$('.expected_quantity').bind('click keyup', function () {
    var $expectedQuantity = $('.expected_quantity').val();
    var $quantity = $('.quantity-step').attr("step");
    var $result = 0;

    if ($expectedQuantity % $quantity === 0) {
        $result = (($expectedQuantity / $quantity)) * $quantity
    } else {
        $result = Math.ceil(($expectedQuantity / $quantity)) * $quantity;
    }
    $('.quantity-step').val($result);
    var $price = $('.price').data('price') * 1;
    var $netto_value = $price * $('.quantity-step').val();
    var $vat = $('div.vat_type').data('vat') * 1;
    $('.total_sum > .price_value > span').html($netto_value);
    
    $('#vatvalue').html(($netto_value * (1 + ($vat / 100)))-$netto_value);
});
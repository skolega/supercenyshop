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
    var $netto_value = ($price * $quantity).toFixed(2);
    var $vat = $('div.vat_type').data('vat') * 1;
    $('.total_sum > .price_value > span').html($netto_value);

    var $vatvalue = (($netto_value * (1 + ($vat / 100))) - $netto_value).toFixed(2);
    $('#vatvalue').html($vatvalue);
});

function getCalculationData() {
    var $expectedQuantity = $('.expected_quantity').val();
    var $quantity = $('.quantity-step').attr("step");
    var $result = $quantity;

    if ($expectedQuantity % $quantity === 0) {
        $result = (($expectedQuantity / $quantity)) * $quantity;
    } else {
        $result = Math.ceil(($expectedQuantity / $quantity)) * $quantity;
    }
    $('.quantity-step').val($result);
}


function calculatePrice() {
    var $price = $('.price').data('price') * 1;
    var $netto_value = ($price * $('.quantity-step').val()).toFixed(2);
    var $vat = $('div.vat_type').data('vat') * 1;
    $('.total_sum > .price_value > span').html($netto_value);
    var $vatvalue = (($netto_value * (1 + ($vat / 100))) - $netto_value).toFixed(2);
    $('#vatvalue').html($vatvalue);
}



$('.variant').on('click', function () {
    $price = $(this).data('price');
    $packing = $(this).data('packing');
    $('.price').html($price);
    $('.price').data('price', $price);
    $('.variant').find('td > input').prop('checked', false);
    $(this).find('td > input').prop('checked', true);
    $('.quantity-input input').prop('min', $packing).prop('step', $packing).prop('value', $packing);
    getCalculationData();
    calculatePrice();
});



$('.expected_quantity').bind('click keyup', function () {
    getCalculationData();
    calculatePrice();
});

$('.quantity-input').find('.quantity-step').bind('click keyup', function () {
    calculatePrice();
});

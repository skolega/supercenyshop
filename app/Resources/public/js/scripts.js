$().ready(function () {

    bootbox.setDefaults({
        locale: "pl",
    });

    
    // dodaje confirm dla linków usuwajacych produkty z koszyka
    $('table a.remove').on('click', function(event) {
        
        var url = $(this).attr('href');
        event.preventDefault();
        bootbox.confirm("Czy napewno chcesz usunąć ten produkt?", function(result) {
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
});
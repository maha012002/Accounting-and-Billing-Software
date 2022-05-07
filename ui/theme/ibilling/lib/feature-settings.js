$(document).ready(function () {

    var _url = $("#_url").val();
    $('#config_accounting').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "accounting", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "accounting", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_invoicing').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "invoicing", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "invoicing", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });

    $('#config_quotes').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "quotes", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "quotes", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    });


    $('#config_client_dashboard').change(function() {

           $('#ui_settings').block({ message: null });


        if($(this).prop('checked')){

            $.post( _url+'settings/update_option/', { opt: "client_dashboard", val: "1" })
                .done(function( data ) {
                    $('#ui_settings').unblock();
                    location.reload();
                });

        }
        else{
            $.post( _url+'settings/update_option/', { opt: "client_dashboard", val: "0" })
                .done(function( data ) {
                      $('#ui_settings').unblock();
                    location.reload();
                });
        }
    })

});
$(document).ready(function () {



    var $modal = $('#ajax-modal');


    var sysrender = $('#application_ajaxrender');

    var _url = $("#_url").val();


    sysrender.on('click', '#mail_quote_created', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');
        $modal.load( _url + 'quotes/mail_invoice_/' + iid + '/created', '', function(){
            $modal.modal();
            $('.sysedit').summernote({

            });
        });
    });




    $modal.on('click', '#send', function(){
        $modal.modal('loading');

        var attach_pdf = 'No';

        if($("#attach_pdf").prop('checked') == true){
            attach_pdf = 'Yes';

        }

        $.post(_url + 'quotes/send_email', {


            message: $('.sysedit').code(),
            subject: $('#subject').val(),

            toname: $('#toname').val(),
            i_cid: $('#i_cid').val(),
            i_iid: $('#i_iid').val(),
            toemail: $('#toemail').val(),
            ccemail: $('#ccemail').val(),
            bccemail: $('#bccemail').val(),
            attach_pdf: attach_pdf

        }).done(function (data) {
            var _url = $("#_url").val();
            $modal
                .modal('loading')
                .find('.modal-body')
                .prepend(data);
        });

    });


    $("#convert_invoice").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                $('#ibox').block({ message: null });
                var iid = $("#iid").val();
                $.post(  _url + "quotes/convert_invoice/", { iid: iid })
                    .done(function( data ) {
                       // console.log(data);
                        $('#ibox').unblock();


                        window.location = _url + 'invoices/view/' + data + '/';

                    });
            }
        });

    });


    $("#mark_draft").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "quotes/mark_draft/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });


    $("#mark_delivered").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "quotes/mark_delivered/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $("#mark_on_hold").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "quotes/mark_on_hold/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $("#mark_accepted").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "quotes/mark_accepted/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $("#mark_lost").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "quotes/mark_lost/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });


    $("#mark_dead").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "quotes/mark_dead/", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $modal.on('click', '#send_bcc_to_admin', function(e){

        e.preventDefault();


        $("#bccemail").val($("#admin_email").val());

    });

    $modal.on('hidden.bs.modal', function () {
        location.reload();
    })

});
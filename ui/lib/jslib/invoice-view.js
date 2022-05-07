$(document).ready(function () {


    var _url = $("#_url").val();

    var $modal = $('#ajax-modal');


    var sysrender = $('#application_ajaxrender');


    //function store_invoice_pdf(iid){
    //
    //    $.get( _url + "invoices/pdf/"+iid+"/store/", function() {
    //
    //    });
    //
    //}


    sysrender.on('click', '#add_payment', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');

        $modal.load( _url + 'invoices/add-payment/' + iid, '', function(){
            $modal.modal();
            $('.amount').autoNumeric('init');
            $(".datepicker").datepicker();
            $("#account").select2({
                theme: "bootstrap"
            });
            $("#cats").select2({
                theme: "bootstrap"
            });
            $("#pmethod").select2({
                theme: "bootstrap"
            });
        });

    });


    sysrender.on('click', '#mail_invoice_created', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');

        $modal.load( _url + 'invoices/mail_invoice_/' + iid + '/created', '', function(){
            $modal.modal();
            $('.sysedit').summernote({

            });
        });


    });

    sysrender.on('click', '#mail_invoice_reminder', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');

        $modal.load( _url + 'invoices/mail_invoice_/' + iid + '/reminder', '', function(){
            $modal.modal();
            $('.sysedit').summernote({

            });
        });

    });

    sysrender.on('click', '#mail_invoice_overdue', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');


        $modal.load( _url + 'invoices/mail_invoice_/' + iid + '/overdue', '', function(){
            $modal.modal();
            $('.sysedit').summernote({

            });
        });


    });

    sysrender.on('click', '#mail_invoice_confirm', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');

        $modal.load( _url + 'invoices/mail_invoice_/' + iid + '/confirm', '', function(){
            $modal.modal();
            $('.sysedit').summernote({

            });
        });

    });

    sysrender.on('click', '#mail_invoice_refund', function(e){
        e.preventDefault();
        var iid = $("#iid").val();

        $('body').modalmanager('loading');
        $modal.load( _url + 'invoices/mail_invoice_/' + iid + '/refund', '', function(){
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



        var _url = $("#_url").val();

        $.post(_url + 'invoices/send_email', {


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

    $modal.on('click', '#save_payment', function(){


        $modal.modal('loading');

        var _url = $("#_url").val();
        $.post(_url + 'invoices/add-payment-post', {


            account: $('#account').val(),
            date: $('#date').val(),
            iid: $('#iid').val(),

            amount: $('#amount').val(),
            cats: $('#cats').val(),
            description: $('#description').val(),
            payer: $('#payer').val(),
            pmethod: $('#pmethod').val()

        }).done(function (data) {

            var _url = $("#_url").val();
            if ($.isNumeric(data)) {
                location.reload();
            }
            else {
                $modal
                    .modal('loading')
                    .find('.modal-body')
                    .prepend(data);
            }
        });

    });

    $("#mark_paid").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "invoices/markpaid", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });


    $("#mark_unpaid").click(function (e) {
        e.preventDefault();


        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
           if(result){
               var iid = $("#iid").val();
               $.post(  _url + "invoices/markunpaid", { iid: iid })
                   .done(function( data ) {
                       location.reload();
                   });
           }
        });

    });

    $("#mark_cancelled").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "invoices/markcancelled", { iid: iid })
                    .done(function( data ) {
                        location.reload();
                    });
            }
        });

    });

    $("#mark_partially_paid").click(function (e) {
        e.preventDefault();
        bootbox.confirm($("#_lan_msg_confirm").val(), function(result) {
            if(result){
                var iid = $("#iid").val();
                $.post(  _url + "invoices/markpartiallypaid", { iid: iid })
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
$(document).ready(function () {

    var result =  $("#result");

    var _url = $("#_url").val();

    result.hide();
    $('.progress').show();
    $('.progress .progress-bar').progressbar();

    $.post(_url + 'search/users/', {

        utype: 'All'

    })
        .done(function (data) {

            setTimeout(function () {
                var sbutton = $("#search");

                sbutton.html('Search');
                sbutton.removeClass("btn-danger");
                $('.progress').hide();

                result.html(data);
                result.show();
                $("#txtloading").html("Manage Users");
            }, 2000);
        });


    var $modal = $('#ajax-modal');

    result.on('click', 'tr', function(){
        $('body').modalmanager('loading');
var uid = this.id;

        setTimeout(function(){
            $modal.load( _url + 'view/user/' + uid + '/', '', function(){
                $modal.modal();
            });
        }, 1000);

    });

    $("#search").click(function (e) {
        e.preventDefault();
        $("#result").hide();
        $('.progress').show();
        $('.progress .progress-bar').progressbar();
        $(this).html("Searching...");
        $(this).addClass("btn-danger");
        var _url = $("#_url").val();
        $.post(_url + 'search/ps/', {

            txtsearch: $('#txtsearch').val(),
            stype: $('#stype').val()

        })
            .done(function (data) {

                setTimeout(function () {
                    var sbutton = $("#search");
                    var result =  $("#result");
                    sbutton.html('Search');
                    sbutton.removeClass("btn-danger");
                    $('.progress').hide();

                    result.html(data);
                    result.show();
                }, 2000);
            });
    });






});
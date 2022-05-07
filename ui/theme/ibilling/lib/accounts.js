$(document).ready(function () {


    $(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        var lan_msg = $("#_lan_are_you_sure").val();
        bootbox.confirm(lan_msg, function(result) {
            if(result){
                var _url = $("#_url").val();
                window.location.href = _url + "accounts/delete/" + id + '/';
            }
        });
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
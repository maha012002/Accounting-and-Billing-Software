$(document).ready(function () {
    $(".progress").hide();
    $("#emsg").hide();
    $('#description').summernote({

        toolbar: [
            //[groupname, [button list]]

            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
        ]
    });
    $("#submit").click(function (e) {
        e.preventDefault();
        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i> Working ...');
        $(this).addClass("btn-danger");
        var _url = $("#_url").val();
        $.post(_url + 'cases/add-post', {

            account: $('#account').val(),
            title: $('#title').val(),
            status: $('#status').val(),
            description: $('#description').code()

        })
            .done(function (data) {

                setTimeout(function () {
                    var sbutton = $("#submit");
                    var _url = $("#_url").val();
                    if ($.isNumeric(data)) {

                        window.location = _url + 'cases/list/all';
                    }
                    else {
                        sbutton.html('<i class="fa fa-check"></i> Submit');
                        sbutton.removeClass("btn-danger");

                        $("#emsgbody").html(data);
                        $("#emsg").show("slow");
                    }
                }, 2000);
            });
    });
});
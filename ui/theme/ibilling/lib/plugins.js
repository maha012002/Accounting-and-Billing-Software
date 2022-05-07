Dropzone.autoDiscover = false;
$(function() {
    var _url = $("#_url").val();
    var ib_file = new Dropzone("#upload_container",
        {
            url: _url + "settings/plugin_upload/",
            maxFiles: 1,
            acceptedFiles: ".zip"
        }
    );

    //ib_file.on("addedfile", function(file) {
    //
    //});

    ib_file.on("success", function(file) {

        var _msg_unzipping = $('#_msg_unzipping').val();
        $('#uploading_inside').block({
            message: "<h3>" + _msg_unzipping +"</h3>" ,
            css: {
                padding:        0,
                margin:         0,
                width:          '30%',
                top:            '40%',
                left:           '35%',
                textAlign:      'center',
                color:          '#FFFFFF',
                border:         '0',
                backgroundColor:'transparent',
                cursor:         'wait'
            }
        });
     //   $('#uploading_inside').block({ message: null });

        var _url = $("#_url").val();
        $.post(_url + 'settings/plugin_unzip/', {

            name: file.name

        })
            .done(function (data) {

                setTimeout(function () {
                    location.reload();
                }, 2000);
            });
    });



    $(".c_uninstall").click(function (e) {
        e.preventDefault();
        var _msg_are_you_sure = $('#_msg_are_you_sure').val();
        var to_url = this.href;
        bootbox.confirm(_msg_are_you_sure, function(result) {
           if(result == true){
               window.location = to_url;
           }
        });



    });



});
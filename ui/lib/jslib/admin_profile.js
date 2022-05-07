$(document).ready(function () {

    var _url = $("#_url").val();


    var croppicHeaderOptions = {

        uploadUrl: _url + 'sys_imgcrop/save/',
        cropData:{
            "email":1,
            "rnd":"rnd"
        },
        cropUrl:  _url + 'sys_imgcrop/crop/',
        outputUrlId:'picture',
        customUploadButtonId:'cropContainerHeaderButton',
        modal:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') }
    }
    var croppic = new Croppic('croppic', croppicHeaderOptions);


    var sysrender = $('#application_ajaxrender');




    sysrender.on('click', '#no_image', function(e){
        e.preventDefault();
        $('#picture').val('');

    });


    sysrender.on('click', '#opt_gravatar', function(e){
        e.preventDefault();

        $('.picture').val('gravatar');

    });

    sysrender.on('click', '#more_submit', function(e){
        e.preventDefault();


        $('#ibox_form').block({ message: null });
        var _url = $("#_url").val();
        $.post(_url + 'contacts/edit-more/', {
            cid: $('#cid').val(),
            picture: $('#picture').val(),
            facebook: $('#facebook').val(),
            google: $('#google').val(),
            linkedin: $('#linkedin').val()

        })
            .done(function (data) {

                setTimeout(function () {
                    var sbutton = $("#more_submit");
                    var _url = $("#_url").val();
                    if ($.isNumeric(data)) {

                        window.location = _url + 'contacts/view/' + data + '/';
                    }
                    else {
                        $('#ibox_form').unblock();

                        $("#emsgbody").html(data);
                        $("#emsg").show("slow");
                    }
                }, 2000);
            });

    });


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue'
    });



});
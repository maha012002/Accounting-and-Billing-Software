$(document).ready(function () {


    var $modal = $('#ajax-modal');
    var sysrender = $('#application_ajaxrender');
    sysrender.on('click', '.cdelete', function(e){
        e.preventDefault();
        var id = this.id;
        var lan_msg = $("#_lan_are_you_sure").val();
        bootbox.confirm(lan_msg, function(result) {
            if(result){
                var _url = $("#_url").val();
                window.location.href = _url + "delete/customfield/" + id + '/';
            }
        });
    });



    sysrender.on('click', '.sys_add', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');
        var _url = $("#_url").val();
        $modal.load(_url + 'settings/customfields-ajax-add/','', function(){
            $modal.modal(
                {

                    width: '600'
                }
            );
        });
    });


    $modal.on('click', '#add_submit', function(){
        $modal.modal('loading');

        var _url = $("#_url").val();
        $.post(_url + 'settings/customfields-post/', $('#add_form').serialize(), function(data){

            var _url = $("#_url").val();
            if ($.isNumeric(data)) {

                location.reload();
            }
            else {

                $modal
                    .modal('loading')
                    .find('.modal-body')
                    .prepend('<div class="alert alert-danger fade in">' + data +

                    '</div>');

            }
        });

    });


    sysrender.on('click', '.sys_edit', function(e){
        e.preventDefault();
        $('body').modalmanager('loading');
        var _url = $("#_url").val();
        var vid = this.id;
        var id = vid.replace("f", "");
            id = vid.replace("d", "");
        $modal.load(_url + 'settings/customfields-ajax-edit/' + id,'', function(){
            $modal.modal(
                {

                    width: '600'
                }
            );
        });
    });


    $modal.on('click', '#edit_submit', function(){
        $modal.modal('loading');

        var _url = $("#_url").val();
        $.post(_url + 'settings/customfield-edit-post/', $('#edit_form').serialize(), function(data){

            var _url = $("#_url").val();
            if ($.isNumeric(data)) {

                location.reload();
            }
            else {

                $modal
                    .modal('loading')
                    .find('.modal-body')
                    .prepend('<div class="alert alert-danger fade in">' + data +

                    '</div>');

            }

        });

    });





});
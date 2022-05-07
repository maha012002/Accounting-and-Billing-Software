$(document).ready(function () {







    var $modal = $('#ajax-modal');

    var _url = $("#_url").val();

    $('#item_add').on('click', function(){

        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');

        setTimeout(function(){
            $modal.load(_url + 'tax/modal-form/', '', function(){
                $modal.modal();
            });
        }, 1000);
    });

    $('.edit').on('click', function(){
        var _url = $("#_url").val();
        var id = $(this).closest('tr').attr('id');
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');

        setTimeout(function(){
            $modal.load(_url + 'tax/edit-form/' + id, '', function(){
                $modal.modal();
            });
        }, 1000);
    });

    $('.delete').on('click', function(){
        var id = $(this).closest('tr').attr('id');
        var lan_msg = $("#_lan_are_you_sure").val();
        bootbox.confirm(lan_msg, function(result) {

          if(result == true){
              var _url = $("#_url").val();
              $.get(_url + 'tax/delete/'+id + '/', function() {
                  window.location = _url + 'tax/list/';
              });
          }

        });

    });


    $modal.on('click', '#save', function(){
        $modal.modal('loading');
        setTimeout(function(){


            var _url = $("#_url").val();
            $.post(_url + 'tax/add-post/', $('#add_form').serialize(), function(data){

                setTimeout(function () {

                    var _url = $("#_url").val();
                    if ($.isNumeric(data)) {

                        window.location = _url + 'tax/list/';
                    }
                    else {

                        $modal
                            .modal('loading')
                            .find('.modal-body')
                            .prepend('<div class="alert alert-danger fade in">' + data +

                            '</div>');

                    }
                }, 2000);
            });
        }, 1000);

    });

    $modal.on('click', '#update', function(){
        $modal.modal('loading');
        setTimeout(function(){


            var _url = $("#_url").val();
            $.post(_url + 'tax/edit-post/', $('#edit_form').serialize(), function(data){

                setTimeout(function () {

                    var _url = $("#_url").val();
                    if ($.isNumeric(data)) {

                        window.location = _url + 'tax/list/';
                    }
                    else {

                        $modal
                            .modal('loading')
                            .find('.modal-body')
                            .prepend('<div class="alert alert-danger fade in">' + data +

                            '</div>');

                    }
                }, 2000);
            });
        }, 1000);

    });

});
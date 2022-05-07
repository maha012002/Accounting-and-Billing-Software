$(function() {

    var _url = $("#_url").val();


    var $ib_box = $(".ibox");


    var $resp = $("#resp");

    var $make_update = $("#make_update");

    var $updateProgressbar = $("#updateProgressbar");

    var $ib_progressing = $("#ib_progressing");





    $make_update.prop('disabled', true);


    // var $action_update = $("#action_update");



    var $btn_save = $("#btn_save");

    var $input_purchase_code = $("#purchase_code");
    autosize($resp);

    function update_check() {
        $resp.focus();

        $ib_box.block({message: block_msg});

        $resp.append("Checking for Updates... \n");

        autosize.update($resp);

        $.post( _url + "settings/check_update_post/", { purchase_code: $input_purchase_code.val()})
            .done(function( data ) {



                var server_resp = data;



                if(server_resp.update_available == 'Yes'){
                    $resp.append("An update is available \n");
                    $resp.append("Latest Build: ");
                    $resp.append(server_resp.remote_build + "\n \n");
                    $resp.append("Changelog: \n");
                    $resp.append("========== \n");
                    $resp.append(server_resp.changelog + "\n");
                    $resp.append("=============================" + "\n");

                    $make_update.prop('disabled', false);

                }
                else if(server_resp.msg){

                    $resp.append(server_resp.msg + "\n");

                }
                else{
                    $resp.append("You are using latest version. \n");
                }



                autosize.update($resp);

                matForms();

                $ib_box.unblock();

            });




    }

    // $check_update.on('click', function(e) {
    //     e.preventDefault();
    //
    //
    // });

    update_check();


    $make_update.on('click', function(e) {
        e.preventDefault();


        var $make_update = $("#make_update");

        $make_update.prop('disabled', true);

        $make_update.html("Updating...");

        $updateProgressbar.show('slow');
        $ib_progressing.attr('data-transitiongoal', 10);
        $ib_progressing.progressbar();




        $resp.append("\n");
        $resp.append("Preparing.... \n");
        $resp.append("Please do not close your browser.... \n");
        $resp.append("Creating backup for logo.... \n");

        $.get( _url + "settings/backup_logo/", function( data ) {

            if(data.continue == 'Yes'){

                $resp.append( data.message + "\n");
                $resp.append( "Getting Download Link..." + "\n");
                autosize.update($resp);

                $.get( _url + "settings/get_latest/", function( data ) {

                    if(data.continue == 'Yes'){

                        $ib_progressing.attr('data-transitiongoal', 20);
                        $ib_progressing.progressbar();

                        var link = data.dl;

                        $resp.append("=============================" + "\n");
                        $resp.append( data.message + "\n");
                        $resp.append("=============================" + "\n");
                        $resp.append( "Downloading..." + "\n");
                        $resp.append("Please do not close your browser.... \n");
                        $resp.append("=============================" + "\n");
                        autosize.update($resp);



                        $.post( _url + "settings/dl_latest/", { link: link })
                            .done(function( data ) {

                                if(data.continue == 'Yes'){

                                    $ib_progressing.attr('data-transitiongoal', 50);
                                    $ib_progressing.progressbar();

                                    $resp.append("=============================" + "\n");
                                    $resp.append( data.message + "\n");
                                    $resp.append("=============================" + "\n");
                                    $resp.append( "Unzipping..." + "\n");

                                    $resp.append("=============================" + "\n");
                                    autosize.update($resp);


                                    $.get( _url + "settings/dl_unzip/", function( data ) {

                                        if(data.continue == 'Yes'){

                                            $ib_progressing.attr('data-transitiongoal', 70);
                                            $ib_progressing.progressbar();

                                            $resp.append("=============================" + "\n");
                                            $resp.append( data.message + "\n");
                                            $resp.append("=============================" + "\n");
                                            $resp.append( "Completing Update...." + "\n");

                                            $resp.append("=============================" + "\n");
                                            autosize.update($resp);


                                            $.get( _url + "settings/update_complete/", function( data ) {

                                                $ib_progressing.attr('data-transitiongoal', 100);
                                                $ib_progressing.progressbar();

                                                $resp.append(data + "\n");

                                                autosize.update($resp);

                                              //  $action_update.html("");
                                                $make_update.html("You are using Latest Version");

                                                $(document).scrollTop($(document).height());

                                            });



                                        }
                                        else{

                                            $resp.append( "Error: " + data.message + "\n");
                                            $make_update.html("Update");
                                            $make_update.prop('disabled', false);
                                            autosize.update($resp);
                                        }



                                    });



                                }
                                else{

                                    $resp.append( "Error: " + data.message + "\n");
                                    $make_update.html("Update");
                                    $make_update.prop('disabled', false);
                                    autosize.update($resp);
                                }
                            });




                    }
                    else{

                        $resp.append( "Error: " + data.message + "\n");
                        $make_update.html("Update");
                        $make_update.prop('disabled', false);
                        autosize.update($resp);
                    }


                });

            }

            else{

                $resp.append( "Error: " + data.message + "\n");
                $make_update.html("Update");
                $make_update.prop('disabled', false);
                autosize.update($resp);
            }


        });





        autosize.update($resp);

        matForms();


    });




    $btn_save.on('click', function(e) {
        e.preventDefault();

        $ib_box.block({message: block_msg});

        $.post( _url + "settings/add_purchase_code/", { purchase_code: $input_purchase_code.val()})
            .done(function( data ) {



                $resp.append(data);

                autosize.update($resp);

                $ib_box.unblock();

            });

    });

});

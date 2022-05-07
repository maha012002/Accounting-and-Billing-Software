{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-12">
            <div id="updateProgressbar" class="progress" style="display: none;">
                <div class="progress progress-striped active">
                    <div class="progress-bar" id="ib_progressing" role="progressbar" data-transitiongoal="10"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins" id="ib_box">
                <div class="ibox-title">
                    <h5>iBilling Build - {$_c['build']}</h5>

                </div>
                <div class="ibox-content" id="ibox_update">



                    <button type="button" id="make_update" class="cls_update btn btn-danger">Update</button>


                </div>
            </div>

            {if $app_stage eq 'Demo'}

                <input type="hidden" name="purchase_code" id="purchase_code" value="">

            {else}

                <div class="ibox float-e-margins" id="ib_box">

                    <div class="ibox-content">


                        <form role="form" name="accadd" method="post" action="{$_url}settings/activate_license_post/">





                            <div class="form-group">
                                <label for="purchase_code">Purchase Code</label>
                                <input type="text" required class="form-control" id="purchase_code" name="purchase_code" value="{$_c['purchase_code']}">
                                <span class="help-block"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">How To Get Your Envato Purchase Code?</a> </span>
                            </div>





                            <button type="submit" id="btn_save" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Save']}</button>
                        </form>




                    </div>
                </div>

            {/if}



        </div>

        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <label for="resp">{$_L['Response']}</label>

                </div>
                <div class="ibox-content">

                    <form class="form-horizontal push-10-t push-10" method="post" onsubmit="return false;">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <textarea class="form-control ib_resp" id="resp" name="resp" rows="9"></textarea>
                                    <label for="api_header_resp">Response</label>
                                </div>

                            </div>
                        </div>

                    </form>




                </div>
            </div>



        </div>



    </div>


{/block}

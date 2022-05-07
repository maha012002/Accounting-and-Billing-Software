{extends file="$tpl_admin_layout"}

{block name="content"}
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default" id="uploading_inside">
                <div class="panel-body">
                    <form action="{$_url}settings/plugin_upload/" class="dropzone" id="upload_container">

                        <div class="dz-message">
                            <h3> <i class="fa fa-cloud-upload"></i>  {$_L['plugin_drop_help']}</h3>
                            <br />
                            <span class="note">{$_L['plugin_upload_help']}</span>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12" style="margin-bottom: 15px;">
            <form role="form" name="accadd" method="post" action="{$_url}settings/get_plugin/">
                <div class="form-group">
                    <label for="account">{$_L['Or Install from URL']}: </label>
                    <input type="text" class="form-control" id="pl_url" name="pl_url" placeholder="Enter Plugin URL...">
                </div>




                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Install</button>
            </form>


        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{$_L['Plugins']}</h5>

                </div>
                <div class="ibox-content">

                    <div class="project-list mt-md">
                        <div id="progressbar">
                        </div>

                        <div id="application_ajaxrender"><table class="table table-hover">
                                <tbody>
                                {$pl_html}
                                </tbody>
                            </table></div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="_msg_unzipping" value="{$_L['Unzipping']} ...">
    <input type="hidden" id="_msg_are_you_sure" value="{$_L['are_you_sure']}">
{/block}
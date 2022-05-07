{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-6">


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Logo']}</h5>


                </div>
                <div class="ibox-content">

                    <img class="logo" src="{$app_url}application/storage/system/logo.png" alt="Logo">
                    <br><br>

                    <form role="form" name="logo" enctype="multipart/form-data" method="post"
                          action="{$_url}settings/logo-post/">
                        <div class="form-group">
                            <label for="file">{$_L['File']}</label>
                            <input type="file" id="file" name="file">

                            <p class="help-block">{$_L['This will replace existing logo']} -
                                application/storage/system/logo.png</p>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>


                </div>
            </div>





            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Client Portal Custom Scripts']}</h5>


                </div>
                <div class="ibox-content">


                    <form role="form" name="logo" method="post"
                          action="{$_url}settings/custom_scripts/">
                        <div class="form-group">
                            <label for="header_scripts">{$_L['Header Scripts']}</label>

                            <textarea class="form-control" id="header_scripts" name="header_scripts"
                                      rows="4">{$_c['header_scripts']}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="footer_scripts">{$_L['Footer Scripts']}</label>

                            <textarea class="form-control" id="footer_scripts" name="footer_scripts"
                                      rows="4">{$_c['footer_scripts']}</textarea>

                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>


                </div>
            </div>


        </div>




    </div>


{/block}

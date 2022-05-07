{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['General Settings']}</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="accadd" method="post" action="{$_url}settings/app-post">
                        <div class="form-group">
                            <label for="company">{$_L['Application Name']}</label>
                            <input type="text" class="form-control" id="company" name="company"
                                   value="{$_c['CompanyName']}">
                            <span class="help-block">{$_L['This Name will be']}</span>
                        </div>



                        <div class="form-group">
                            <label for="default_landing_page">{$_L['Default Landing Page']}</label>
                            <select name="default_landing_page" id="default_landing_page" class="form-control">
                                <option value="login"
                                        {if $_c['default_landing_page'] eq 'login'}selected="selected" {/if}>{$_L['Admin Login']}</option>
                                <option value="client/login"
                                        {if $_c['default_landing_page'] eq 'client/login'}selected="selected" {/if}>{$_L['Client Login']}</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="opt_dashboard">{$_L['Dashboard']}</label>
                            <select name="dashboard" id="opt_dashboard" class="form-control">
                                <option value="canvas"
                                        {if $_c['dashboard'] eq 'canvas'}selected="selected" {/if}>Canvas</option>
                                <option value="legacy"
                                        {if $_c['dashboard'] eq 'legacy'}selected="selected" {/if}>Legacy</option>


                            </select>
                        </div>





                        <hr>

                        <div class="form-group">
                            <label for="caddress">{$_L['Pay To Address']}</label>

                            <textarea class="form-control" id="caddress" name="caddress"
                                      rows="3">{$_c['caddress']}</textarea>
                            <span class="help-block">{$_L['You can use html tag']}</span>
                        </div>

                        <div class="form-group">

                            <label for="invoice_terms">{$_L['Default Invoice Terms']}</label>

                            <textarea class="form-control" id="invoice_terms" name="invoice_terms"
                                      rows="3">{$_c['invoice_terms']}</textarea>

                        </div>

                        <div class="form-group">
                            <label for="iai">{$_L['Invoice Starting']} #</label>
                            <input type="text" class="form-control" id="iai" name="iai">
                            <span class="help-block">{$_L['Enter to set the next invoice']}
                                - <strong>{$ai}</strong> ({$_L['Keep Blank for']})</span>
                        </div>

                        <div class="form-group">
                            <label for="pdf_font">{$_L['PDF Font']}</label>
                            <select name="pdf_font" id="pdf_font" class="form-control">
                                <option value="default" {if $_c['pdf_font'] eq 'default'}selected="selected" {/if}>Default
                                    [Faster PDF Creation with Less Memory]
                                </option>
                                <option value="Helvetica" {if $_c['pdf_font'] eq 'Helvetica'}selected="selected" {/if}>
                                    Helvetica
                                </option>
                                <option value="dejavusanscondensed"
                                        {if $_c['pdf_font'] eq 'dejavusanscondensed'}selected="selected" {/if}>
                                    dejavusanscondensed [Embed fonts with supports UTF8]
                                </option>

                                <option value="AdobeCJK" {if $_c['pdf_font'] eq 'AdobeCJK'}selected="selected" {/if}>
                                    AdobeCJK [Adobe Asian Font pack]
                                </option>

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="i_driver">{$_L['Invoice Creation Method']}</label>
                            <select name="i_driver" id="i_driver" class="form-control">
                                <option value="default"
                                        {if $_c['i_driver'] eq 'default'}selected="selected" {/if}>{$_L['Legacy']}</option>
                                <option value="v2"
                                        {if $_c['i_driver'] eq 'v2'}selected="selected" {/if}>{$_L['New']}</option>


                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>

                </div>
            </div>







            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Google reCAPTCHA</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="accadd" method="post" action="{$_url}settings/recaptcha_post/">

                        <div class="form-group">
                            <label for="recaptcha">{$_L['Enable Recaptcha']}</label>
                            <select name="recaptcha" id="recaptcha" class="form-control">
                                <option value="1"
                                        {if $_c['recaptcha'] eq '1'}selected="selected" {/if}>{$_L['Yes']}</option>
                                <option value="0"
                                        {if $_c['recaptcha'] eq '0'}selected="selected" {/if}>{$_L['No']}</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recaptcha_sitekey">{$_L['Recaptcha']} {$_L['Site Key']}</label>
                            <input type="text" class="form-control" id="recaptcha_sitekey" name="recaptcha_sitekey" value="{$_c['recaptcha_sitekey']}">

                        </div>

                        <div class="form-group">
                            <label for="recaptcha_secretkey">{$_L['Recaptcha']} {$_L['Secret Key']}</label>
                            <input type="text" class="form-control" id="recaptcha_secretkey" name="recaptcha_secretkey" value="{$_c['recaptcha_secretkey']}">

                        </div>



                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>

                </div>
            </div>




            <div class="ibox float-e-margins" id="additional_settings">
                <div class="ibox-title">
                    <h5>{$_L['Additional Settings']}</h5>


                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <tbody>

                        <tr>
                            <td width="80%"><label for="url_rewrite">{$_L['URL Rewrite']} </label>
                                <br>
                                <p>Please do not enable this, unless you are sure.</p>
                            </td>
                            <td><input type="checkbox" {if get_option('url_rewrite') eq '1'}checked{/if}
                                       data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}"
                                       id="url_rewrite"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label
                                        for="console_notify_invoice_created">{$_L['cron_invoice_created']} </label></td>
                            <td><input type="checkbox" {if get_option('console_notify_invoice_created') eq '1'}checked{/if}
                                       data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}"
                                       id="console_notify_invoice_created"></td>
                        </tr>


                        </tbody>
                    </table>


                </div>
            </div>


        </div>


    </div>


{/block}

{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Email Settings']}</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="eml" method="post" action="{$_url}settings/eml-post">


                        <div class="form-group">
                            <label for="email_method">{$_L['Send Email Using']}</label>
                            <select name="email_method" id="email_method" class="form-control">
                                <option value="phpmail" {if $e['method'] eq 'phpmail'}selected="selected" {/if}>{$_L['PHP mail Function']}</option>
                                <option value="smtp" {if $e['method'] eq 'smtp'}selected="selected" {/if}>{$_L['SMTP']}</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sysemail">{$_L['System Email']}</label>
                            <input type="text" class="form-control" id="sysemail" name="sysemail" value="{$_c['sysEmail']}">
                            <span class="help-block">{$_L['All Outgoing Email Will']}</span>
                        </div>

                        <div id="a_hide">
                            <div class="form-group">
                                <label for="smtp_host">{$_L['SMTP Host']}</label>
                                <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="{$e['host']}">

                            </div>

                            <div class="form-group">
                                <label for="smtp_user">{$_L['SMTP Username']}</label>
                                <input type="text" class="form-control" id="smtp_user" name="smtp_user" value="{$e['username']}">

                            </div>

                            <div class="form-group">
                                <label for="smtp_password">{$_L['SMTP Password']}</label>
                                <input type="password" class="form-control" id="smtp_password" name="smtp_password" value="{$e['password']}">

                            </div>

                            <div class="form-group">
                                <label for="smtp_port">{$_L['SMTP Port']}</label>
                                <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="{$e['port']}">

                            </div>

                            <div class="form-group">
                                <label for="smtp_secure">{$_L['SMTP Secure']}</label>
                                <select name="smtp_secure" id="smtp_secure" class="form-control">
                                    <option value="tls" {if $e['secure'] eq 'tls'}selected="selected" {/if}>{$_L['TLS']}</option>
                                    <option value="ssl" {if $e['secure'] eq 'ssl'}selected="selected" {/if}>{$_L['SSL']}</option>

                                </select>

                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>

                </div>
            </div>
        </div>






    </div>

{/block}

{block name="script"}
    <script>
        $(function () {


        })
    </script>
{/block}

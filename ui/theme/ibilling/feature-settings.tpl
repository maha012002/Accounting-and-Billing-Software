{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-6">






            <div class="ibox float-e-margins" id="ui_settings">
                <div class="ibox-title">
                    <h5>{$_L['Choose Features']}</h5>


                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <tbody>

                        <tr>
                            <td width="80%"><label for="config_accounting">{$_L['Accounting']} </label></td>
                            <td> <input type="checkbox" {if get_option('accounting') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_accounting"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_invoicing">{$_L['Invoicing']} </label></td>
                            <td> <input type="checkbox" {if get_option('invoicing') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_invoicing"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label for="config_quotes">{$_L['Quotes']} </label></td>
                            <td> <input type="checkbox" {if get_option('quotes') eq '1'}checked{/if} data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="config_quotes"></td>
                        </tr>



                        </tbody>
                    </table>



                </div>
            </div>


        </div>



    </div>

{/block}

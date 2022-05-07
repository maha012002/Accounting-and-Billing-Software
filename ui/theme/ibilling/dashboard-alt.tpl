{extends file="$tpl_admin_layout"}

{block name="content"}



    <div class="row">
        <div class="col-md-12" id="ib_graph"></div>
        <div class="col-lg-3">
            <div class="widget style1 lazur-bg info-tile info-tile-alt tile-teal">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> {$_L['Income Today']} </span>

                        <h3 class="font-bold amount">{$ti}</h3>
                        <a href="{$_url}transactions/deposit/" class="btn btn-success btn-xs">{$_L['Add Deposit']}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="widget style1 red-bg info-tile info-tile-alt tile-danger">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-minus fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> {$_L['Expense Today']} </span>

                        <h3 class="font-bold amount">{$te}</h3>
                        <a href="{$_url}transactions/expense/" class="btn btn-warning btn-xs">{$_L['Add Expense']}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="widget style1 lazur-bg info-tile info-tile-alt tile-success">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> {$_L['Income This Month']} </span>

                        <h3 class="font-bold amount">{$mi}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="widget style1 red-bg info-tile info-tile-alt tile-blue">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-minus fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> {$_L['Expense This Month']} </span>
                        <h3 class="font-bold amount">{$me}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="sort_3">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="{$_url}transactions/list/" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> {$_L['All_Transactions']}</a>
                    <h5>{$_L['Income n Expense']} - {ib_lan_get_line(date('F'))} {date('Y')}</h5>
                </div>
                <div class="ibox-content">
                    <div id="chart"></div>
                </div>
            </div>

        </div>
        <!-- Widget-5 end-->

    </div>
    <div class="row" id="sort_2">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="#" id="set_goal" class="btn btn-primary btn-xs pull-right"><i class="fa fa-bullseye"></i> {$_L['Set Goal']}</a>
                    <h5>{$_L['Net Worth n Account Balances']}</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <h3 class="text-center amount">{$net_worth}</h3>
                        <div>
                            <span class="amount">{$net_worth}</span> {$_L['of']} <span class="amount">{$_c['networth_goal']}</span>
                            <small class="pull-right"><span class="amount">{$pg}</span>%</small>
                        </div>


                        <div class="progress progress-small">
                            <div style="width: {$pgb}%;" class="progress-bar progress-bar-{$pgc}"></div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" style="margin-top: 26px;">
                        <th>{$_L['Account']}</th>
                        <th class="text-right">{$_L['Balance']}</th>
                        {foreach $d as $ds}
                            <tr>
                                <td>{$ds['account']}</td>
                                <td class="text-right"><span class="amount{if $ds['balance'] < 0} text-red{/if}">{$ds['balance']}</span></td>
                            </tr>
                        {/foreach}



                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>{$_L['Income vs Expense']} - {ib_lan_get_line(date('F'))} {date('Y')}</h5>
                </div>
                <div class="ibox-content">
                    <div id="dchart"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Row end-->

    <div class="row" id="sort_4">


        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="{$_url}invoices/list/" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> {$_L['Invoices']}</a>
                    <h5>{$_L['Recent Invoices']}</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Account']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Invoice Date']}</th>
                            <th>{$_L['Due Date']}</th>
                            <th>{$_L['Status']}</th>
                            <th>{$_L['Type']}</th>
                            <th class="text-right">{$_L['Manage']}</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach $invoices as $ds}
                            <tr>
                                <td><a href="{$_url}invoices/view/{$ds['id']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>
                                <td><a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a> </td>
                                <td class="amount">{$ds['total']}</td>
                                <td>{date( $_c['df'], strtotime($ds['date']))}</td>
                                <td>{date( $_c['df'], strtotime($ds['duedate']))}</td>
                                <td>
                                    {ib_lan_get_line($ds['status'])}

                                </td>
                                <td>
                                    {if $ds['r'] eq '0'}
                                        <span class="label label-success"><i class="fa fa-dot-circle-o"></i> {$_L['Onetime']}</span>
                                    {else}
                                        <span class="label label-success"><i class="fa fa-repeat"></i> {$_L['Recurring']}</span>
                                    {/if}
                                </td>
                                <td class="text-right">
                                    <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>
                                    <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {$_L['Edit']}</a>
                                </td>
                            </tr>
                        {/foreach}

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>

    <div class="row" id="sort_3">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>{$_L['Latest Income']}</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered">
                        <th>{$_L['Date']}</th>
                        <th>{$_L['Description']}</th>
                        <th class="text-right">{$_L['Amount']}</th>
                        {foreach $inc as $incs}
                            <tr>
                                <td>{date( $_c['df'], strtotime($incs['date']))}</td>
                                <td><a href="{$_url}transactions/manage/{$incs['id']}/">{$incs['description']}</a> </td>
                                <td class="text-right amount">{$incs['amount']}</td>
                            </tr>
                        {/foreach}



                    </table>
                </div>
            </div>

        </div>


        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>{$_L['Latest Expense']}</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered">
                        <th>{$_L['Date']}</th>
                        <th>{$_L['Description']}</th>
                        <th class="text-right">{$_L['Amount']}</th>
                        {foreach $exp as $exps}
                            <tr>
                                <td>{date( $_c['df'], strtotime($exps['date']))}</td>
                                <td><a href="{$_url}transactions/manage/{$exps['id']}/">{$exps['description']}</a> </td>
                                <td class="text-right amount">{$exps['amount']}</td>
                            </tr>
                        {/foreach}



                    </table>
                </div>
            </div>

        </div>


    </div>


{/block}

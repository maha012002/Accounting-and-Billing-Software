{include file="sections/header.tpl"}

<div class="row">

    <div class="col-md-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">


                <h5>{$user->account}</h5>


            </div>
            <div class="ibox-content">


                <address>
                    {if $user->company neq ''}
                        {$user->company}
                        <br>
                        {$user->account}
                        <br>
                    {else}
                        {$user->account}
                        <br>
                    {/if}
                    {$user->address} <br>
                    {$user->city} <br>
                    {$user->state} - {$user->zip} <br>
                    {$user->country}
                    <br>
                    <strong>{$_L['Phone']}:</strong> {$user->phone}
                    <br>
                    <strong>{$_L['Email']}:</strong> {$user->email}
                    {foreach $cf as $cfs}
                        <br>
                        <strong>{$cfs['fieldname']}: </strong> {get_custom_field_value($cfs['id'],$user->id)}
                    {/foreach}

                </address>

                <a href="{$_url}client/profile/" class="btn btn-primary"><i class="icon-user-1"></i> Edit Profile</a>

                {$dashboard_summary_extras}



            </div>
        </div>
    </div>

    <div class="col-md-8">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{$_L['Recent Transactions']}</h5>

            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-bordered sys_table">
                        <th>{$_L['Date']}</th>
                        <th>{$_L['Account']}</th>
                        <th>{$_L['Type']}</th>

                        <th class="text-right">{$_L['Amount']}</th>

                        <th>{$_L['Description']}</th>
                        <th class="text-right">{$_L['Dr']}</th>
                        <th class="text-right">{$_L['Cr']}</th>
                        {*<th class="text-right">{$_L['Balance']}</th>*}
                        {*<th>{$_L['Manage']}</th>*}
                        {foreach $t as $ds}
                            <tr class="{if $ds['cr'] eq '0.00'}warning {else}info{/if}">
                                <td>{date( $_c['df'], strtotime($ds['date']))}</td>
                                <td>{$ds['account']}</td>
                                {*<td>{$ds['type']}</td>*}
                                {* From v 2.4 Sadia Sharmin *}

                                <td>
                                    {if $ds['type'] eq 'Income'}
                                        {$_L['Paid']}
                                    {elseif $ds['type'] eq 'Expense'}
                                        {$_L['Received']}
                                    {elseif $ds['type'] eq 'Transfer'}
                                        {$_L['Transfer']}
                                    {else}
                                        {$ds['type']}
                                    {/if}
                                </td>

                                <td class="text-right amount">{$ds['amount']}</td>
                                <td>{$ds['description']}</td>
                                <td class="text-right amount">{$ds['dr']}</td>
                                <td class="text-right amount">{$ds['cr']}</td>

                            </tr>
                        {/foreach}



                    </table>
                    </div>



            </div>
        </div>

    </div>


</div>

{$dashboard_extra_row_1}

<div class="row">

    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">


                <h5>{$_L['Recent Invoices']}</h5>


            </div>
            <div class="ibox-content">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover sys_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Account']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Invoice Date']}</th>
                            <th>{$_L['Due Date']}</th>
                            <th>
                                {$_L['Status']}
                            </th>

                            <th class="text-right">{$_L['Manage']}</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach $d as $ds}
                            <tr>
                                <td><a target="_blank" href="{$_url}client/iview/{$ds['id']}/token_{$ds['vtoken']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>
                                <td>{$ds['account']} </td>
                                <td class="amount" data-a-sign="{if $ds['currency_symbol'] eq ''} {$_c['currency_code']} {else} {$ds['currency_symbol']}{/if} ">{$ds['total']}</td>
                                <td>{date( $_c['df'], strtotime($ds['date']))}</td>
                                <td>{date( $_c['df'], strtotime($ds['duedate']))}</td>
                                <td>

                                    {if $ds['status'] eq 'Unpaid'}
                                        <span class="label label-danger">{ib_lan_get_line($ds['status'])}</span>
                                    {elseif $ds['status'] eq 'Paid'}
                                        <span class="label label-success">{ib_lan_get_line($ds['status'])}</span>
                                    {elseif $ds['status'] eq 'Partially Paid'}
                                        <span class="label label-info">{ib_lan_get_line($ds['status'])}</span>
                                    {elseif $ds['status'] eq 'Cancelled'}
                                        <span class="label">{ib_lan_get_line($ds['status'])}</span>
                                    {else}
                                        {ib_lan_get_line($ds['status'])}
                                    {/if}



                                </td>

                                <td class="text-right">
                                    <a target="_blank" href="{$_url}client/iview/{$ds['id']}/token_{$ds['vtoken']}/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>
                                    <a href="{$_url}client/ipdf/{$ds['id']}/token_{$ds['vtoken']}/dl/" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> {$_L['Download']}</a>
                                    <a target="_blank" href="{$_url}iview/print/{$ds['id']}/token_{$ds['vtoken']}/" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> {$_L['Print']}</a>

                                </td>
                            </tr>
                        {/foreach}

                        </tbody>



                    </table>

                </div>



            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-12">


        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><h5>{$_L['Recent Quotes']}</h5></h5>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover sys_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{$_L['Account']}</th>
                            <th width="30%">{$_L['Subject']}</th>
                            <th>{$_L['Amount']}</th>
                            <th>{$_L['Date Created']}</th>
                            <th>{$_L['Expiry Date']}</th>
                            {*<th>{$_L['Stage']}</th>*}

                            <th class="text-right">{$_L['Manage']}</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach $q as $ds}
                            <tr>
                                <td><a href="{$_url}quotes/view/{$ds['id']}/">{$ds['id']}</a> </td>
                                <td><a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a> </td>
                                <td><a href="{$_url}quotes/view/{$ds['id']}/">{$ds['subject']}</a> </td>
                                <td class="amount">{$ds['total']}</td>
                                <td>{date( $_c['df'], strtotime($ds['datecreated']))}</td>
                                <td>{date( $_c['df'], strtotime($ds['validuntil']))}</td>


                                <td class="text-right">
                                    <a href="{$_url}client/q/{$ds['id']}/token_{$ds['vtoken']}/" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>

                                    <a href="{$_url}client/qpdf/{$ds['id']}/token_{$ds['vtoken']}/dl/" class="btn btn-primary btn-xs" ><i class="fa fa-file-pdf-o"></i> {$_L['Download']}</a>
                                    <a href="{$_url}client/qpdf/{$ds['id']}/token_{$ds['vtoken']}/" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> {$_L['Print']}</a>
                                </td>
                            </tr>
                        {/foreach}

                        </tbody>
                    </table>
                </div>



            </div>
        </div>

    </div>

</div>


{include file="sections/footer.tpl"}

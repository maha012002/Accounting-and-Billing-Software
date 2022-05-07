{include file="sections/header.tpl"}
<div class="ibox float-e-margins">
    <div class="ibox-title">


            <h5>{$_L['Total']} : {$total_invoice}</h5>


    </div>
    <div class="ibox-content">

        <div class="table-responsive">

            <table class="table table-bordered table-hover sys_table">
                <thead>
                <tr>
                    <th>#</th>

                    <th>{$_L['Amount']}</th>
                    <th>{$_L['Invoice Date']}</th>
                    <th>{$_L['Due Date']}</th>
                    <th>
                        {$_L['Status']}
                    </th>

                    <th class="text-right" width="100px">{$_L['Manage']}</th>
                </tr>
                </thead>
                <tbody>

                {foreach $d as $ds}
                    <tr>
                        <td><a target="_blank" href="{$_url}client/iview/{$ds['id']}/token_{$ds['vtoken']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>

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
                            <a target="_blank" href="{$_url}client/iview/{$ds['id']}/token_{$ds['vtoken']}/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> </a>
                            <a href="{$_url}client/ipdf/{$ds['id']}/token_{$ds['vtoken']}/dl/" class="btn btn-primary btn-xs"><i class="fa fa-file-pdf-o"></i> </a>
                            <a target="_blank" href="{$_url}iview/print/{$ds['id']}/token_{$ds['vtoken']}/" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> </a>

                        </td>
                    </tr>

                    {foreachelse}

                    <tr>
                        <td colspan="8">
                            You do not have any Invoice.
                        </td>
                    </tr>

                {/foreach}

                </tbody>



            </table>

        </div>




    </div>
</div>
{include file="sections/footer.tpl"}

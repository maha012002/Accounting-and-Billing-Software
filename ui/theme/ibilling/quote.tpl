{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="exampleInputEmail1">{$_L['Unique Quote URL']}:</label>
                <input type="text" class="form-control" id="invoice_public_url" onClick="this.setSelectionRange(0, this.value.length)" value="{$_url}client/q/{$d['id']}/token_{$d['vtoken']}">
            </div>
        </div>
        <div class="col-lg-12"  id="application_ajaxrender">
            <div class="ibox float-e-margins" id="ibox">
                <div class="ibox-title">
                    <h5>{$_L['Quote']} - {$d['invoicenum']}{if $d['cn'] neq ''} {$d['cn']} {else} {$d['id']} {/if}</h5>

                    <input type="hidden" name="iid" value="{$d['id']}" id="iid">



                    <div class="btn-group  pull-right" role="group" aria-label="...">


                        <div class="btn-group" role="group">
                            <button type="button" class="btn  btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>  {$_L['Send Email']}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" id="mail_quote_created">{$_L['Quote Created']}</a></li>

                            </ul>
                        </div>

                        <div class="btn-group" role="group">
                            <button type="button" class="btn  btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>  {$_L['Mark As']}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                {if $d['stage'] neq 'Draft'}
                                    <li><a href="#" id="mark_draft">{$_L['Draft']}</a></li>
                                {/if}
                                {if $d['stage'] neq 'Delivered'}
                                    <li><a href="#" id="mark_delivered">{$_L['Delivered']}</a></li>
                                {/if}
                                {if $d['stage'] neq 'On Hold'}
                                    <li><a href="#" id="mark_on_hold">{$_L['On Hold']}</a></li>
                                {/if}
                                {if $d['stage'] neq 'Accepted'}
                                    <li><a href="#" id="mark_accepted">{$_L['Accepted']}</a></li>
                                {/if}

                                {if $d['stage'] neq 'Lost'}
                                    <li><a href="#" id="mark_lost">{$_L['Lost']}</a></li>
                                {/if}

                                {if $d['stage'] neq 'Dead'}
                                    <li><a href="#" id="mark_dead">{$_L['Dead']}</a></li>
                                {/if}

                            </ul>
                        </div>



                        <a href="{$_url}client/q/{$d['id']}/token_{$d['vtoken']}" target="_blank" class="btn btn-primary  btn-sm"><i class="fa fa-paper-plane-o"></i> {$_L['Preview']}</a>
                        <a href="{$_url}quotes/edit/{$d['id']}/" class="btn btn-warning  btn-sm"><i class="fa fa-pencil"></i> {$_L['Edit']}</a>
                        <button type="button" class="btn  btn-danger btn-sm" id="convert_invoice"><i class="fa fa-plus"></i> {$_L['Convert to Invoice']}</button>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn  btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-file-pdf-o"></i>
                                {$_L['PDF']}
                                <span class="caret"></span>
                            </button>
                            {*<ul class="dropdown-menu" role="menu">*}
                                {*<li><a href="{$_url}quotes/pdf/{$d['id']}/view" target="_blank">{$_L['View PDF']}</a></li>*}
                                {*<li><a href="{$_url}quotes/pdf/{$d['id']}/dl">{$_L['Download PDF']}</a></li>*}
                            {*</ul>*}
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{$_url}client/qpdf/{$d['id']}/token_{$d['vtoken']}/view" target="_blank">{$_L['View PDF']}</a></li>
                                <li><a href="{$_url}client/qpdf/{$d['id']}/token_{$d['vtoken']}/dl">{$_L['Download PDF']}</a></li>
                            </ul>
                        </div>
                        {*<a href="{$_url}iview/print/{$d['id']}/token_{$d['vtoken']}" target="_blank" class="btn btn-primary  btn-sm"><i class="fa fa-print"></i> {$_L['Print']}</a>*}


                    </div>

                </div>
                <div class="ibox-content">


                    {if $d['stage'] eq 'Lost'}
                        <div id="ribbon-alert-container">
                            <a href="javascript:void(0)" id="ribbon">{$_L['Lost']}</a>
                        </div>
                    {elseif $d['stage'] eq 'Accepted'}
                        <div id="ribbon-container">
                            <a href="javascript:void(0)" id="ribbon">{$_L['Accepted']}</a>

                        </div>
                    {elseif $d['stage'] eq 'Delivered'}
                        <div id="ribbon-container">
                            <a href="javascript:void(0)" id="ribbon">{$_L['Delivered']}</a>
                        </div>
                    {elseif $d['stage'] eq 'Draft'}
                        <div id="ribbon-container">
                            <a href="javascript:void(0)" id="ribbon">{$_L['Draft']}</a>
                        </div>
                    {elseif $d['stage'] eq 'Dead'}
                        <div id="ribbon-alert-container">
                            <a href="javascript:void(0)" id="ribbon">{$_L['Dead']}</a>
                        </div>
                    {elseif $d['stage'] eq 'On Hold'}
                        <div id="ribbon-alert-container">
                            <a href="javascript:void(0)" id="ribbon">{$_L['On Hold']}</a>
                        </div>

                    {else}
                        <div id="ribbon-container">

                            <a href="javascript:void(0)" id="ribbon">{$d['stage']}</a>
                        </div>
                    {/if}

                    <div class="invoice">
                        <header class="clearfix">
                            <div class="row">
                                <div class="col-md-12 mt-md">
                                    <h2 class="h2 mt-none mb-sm text-dark text-bold">{$_c['CompanyName']}</h2>
                                    <h4 class="h4 m-none text-dark text-bold">{$_L['Quote']} #{$d['invoicenum']}{if $d['cn'] neq ''} {$d['cn']} {else} {$d['id']} {/if}</h4>

                                </div>

                            </div>
                        </header>
                        <div class="bill-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bill-to">
                                        <p class="h5 mb-xs text-dark text-semibold"><strong>{$_L['Recipient']}:</strong></p>
                                        <address>
                                            {if $a['company'] neq ''}
                                                {$a['company']}
                                                <br>
                                                {$_L['ATTN']}: {$d['account']}
                                                <br>
                                            {else}
                                                {$d['account']}
                                                <br>
                                            {/if}

                                            {$a['address']} <br>
                                            {$a['city']} <br>
                                            {$a['state']} - {$a['zip']} <br>
                                            {$a['country']}
                                            <br>
                                            <strong>{$_L['Phone']}:</strong> {$a['phone']}
                                            <br>
                                            <strong>{$_L['Email']}:</strong> {$a['email']}
                                            {foreach $cf as $cfs}
                                                <br>
                                                <strong>{$cfs['fieldname']}: </strong> {get_custom_field_value($cfs['id'],$a['id'])}
                                            {/foreach}

                                            {$x_html}
                                        </address>





                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bill-data text-right">
                                        <address class="ib mr-xlg">
                                            {$_c['caddress']}
                                        </address>
                                        <div class="ib">
                                            <img src="{$app_url}application/storage/system/logo.png" alt="Logo">
                                        </div>
                                        <p class="mb-none mt-lg">
                                            <span class="text-dark">{$_L['Date Created']}:</span>
                                            <span class="value">{date( $_c['df'], strtotime($d['datecreated']))}</span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark">{$_L['Expiry Date']}:</span>
                                            <span class="value">{date( $_c['df'], strtotime($d['validuntil']))}</span>
                                        </p>
                                        <h2> {$_L['Total']}: <span class="amount">{$d['total']}</span> </h2>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>

                                <strong>{$d['subject']}</strong>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                {$d['proposal']}
                                <hr>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table invoice-items">
                                <thead>
                                <tr class="h4 text-dark">
                                    <th id="cell-id" class="text-semibold">#</th>
                                    <th id="cell-item" class="text-semibold">{$_L['Item']}</th>

                                    <th id="cell-price" class="text-center text-semibold">{$_L['Price']}</th>
                                    <th id="cell-qty" class="text-center text-semibold">{$_L['Quantity']}</th>
                                    <th id="cell-total" class="text-center text-semibold">{$_L['Total']}</th>
                                </tr>
                                </thead>
                                <tbody>

                                {foreach $items as $item}
                                    <tr>
                                        <td>{$item['itemcode']}</td>
                                        <td class="text-semibold text-dark">{$item['description']}</td>

                                        <td class="text-center amount">{$item['amount']}</td>
                                        <td class="text-center">{$item['qty']}</td>
                                        <td class="text-center amount">{$item['total']}</td>
                                    </tr>
                                {/foreach}

                                </tbody>
                            </table>
                        </div>

                        <div class="invoice-summary">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-8">
                                    <table class="table h5 text-dark">
                                        <tbody>
                                        <tr class="b-top-none">
                                            <td colspan="2">{$_L['Subtotal']}</td>
                                            <td class="text-left amount">{$d['subtotal']}</td>
                                        </tr>
                                        {if ($d['discount']) neq '0.00'}
                                            <tr>
                                                <td colspan="2">{$_L['Discount']}</td>
                                                <td class="text-left amount">{$d['discount']}</td>
                                            </tr>
                                        {/if}
                                        <tr>
                                            <td colspan="2">{$d['taxname']}</td>
                                            <td class="text-left amount">{$d['tax1']}</td>
                                        </tr>

                                        <tr class="h4">
                                            <td colspan="2">{$_L['Grand Total']}</td>
                                            <td class="text-left amount">{$d['total']}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                {$d['customernotes']}
                            </div>
                        </div>
                    </div>




                    {*{if ($d['notes']) neq ''}*}
                    {*<div class="well m-t">*}
                    {*{$d['notes']}*}
                    {*</div>*}
                    {*{/if}*}





                </div>


            </div>
        </div>
    </div>

    <input type="hidden" id="_lan_msg_confirm" value="{$_L['are_you_sure']}">

    <input type="hidden" id="admin_email" value="{$user->username}">


{/block}

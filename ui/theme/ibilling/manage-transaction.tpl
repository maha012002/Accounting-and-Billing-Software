{extends file="$tpl_admin_layout"}

{block name="content"}
    <div class="row">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Edit Transaction']} - [#{ib_lan_get_line($t['type'])}-{$t['id']}]</h5>

                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                    <form class="form-horizontal" method="post" id="tform" role="form">
                        <div class="form-group">
                            <label for="account" class="col-sm-3 control-label">{$_L['Account']}</label>
                            <div class="col-sm-9">
                                <select id="account" name="account" class="form-control" disabled>
                                    {foreach $d as $ds}
                                        <option value="{$ds['account']}" {if $ds['account'] eq $t['account']}selected="selected" {/if}>{$ds['account']}</option>
                                    {/foreach}


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-3 control-label">{$_L['Date']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  value="{$t['date']}" name="date" id="date" datepicker data-date-format="yyyy-mm-dd" data-auto-close="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">{$_L['Description']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description" value="{$t['description']}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-3 control-label">{$_L['Amount']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control amount" id="amount"  data-a-sign="{$_c['currency_code']} " data-d-group="2" value="{$t['amount']}"  name="amount" disabled>
                            </div>
                        </div>

                        {if $t['type'] neq 'Transfer'}
                            <div class="form-group">
                                <label for="cats" class="col-sm-3 control-label">{$_L['Category']}</label>
                                <div class="col-sm-9">
                                    <select id="cats" name="cats" class="form-control">
                                        <option value="Uncategorized">{$_L['Uncategorized']}</option>
                                        {foreach $cats as $cat}
                                            <option value="{$cat['name']}" {if $cat['name'] eq $t['category']}selected="selected" {/if}>{$cat['name']}</option>
                                        {/foreach}


                                    </select>
                                </div>
                            </div>
                        {else}
                            <input type="hidden" name="cats" id="cats" value="">
                        {/if}



                        <div class="form-group">
                            <label for="tags" class="col-sm-3 control-label">{$_L['Tags']}</label>
                            <div class="col-sm-9">
                                <select name="tags[]" id="tags"  class="form-control" multiple="multiple">
                                    {foreach $tags as $tag}
                                        <option value="{$tag['text']}" {if in_array($tag['text'],$dtags)}selected="selected"{/if}>{$tag['text']}</option>
                                    {/foreach}

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                &nbsp;
                            </div>
                            <div class="col-sm-9">
                                <h4><a href="#" id="a_toggle">{$_L['Advanced']}</a> </h4>
                            </div>
                        </div>
                        <div id="a_hide">
                            {if $t['type'] eq 'Income'}
                                <div class="form-group">
                                    <label for="payer" class="col-sm-3 control-label">{$_L['Payer']}</label>
                                    <div class="col-sm-9">
                                        <select id="payer" name="payer" class="s2 form-control">
                                            <option value="">{$_L['Choose Contact']}</option>
                                            {foreach $p as $ps}
                                                <option value="{$ps['id']}" {if ($t['payerid']) eq ($ps['id'])}selected="selected" {/if}>{$ps['account']}</option>
                                            {/foreach}


                                        </select>
                                        <input type="hidden" name="payee" id="payee" value="0">
                                    </div>
                                </div>
                            {else}
                                <div class="form-group">
                                    <label for="payee" class="col-sm-3 control-label">{$_L['Payee']}</label>
                                    <div class="col-sm-9">
                                        <select id="payee" name="payee" class="s2 form-control">
                                            <option value="">{$_L['Choose Contact']}</option>
                                            {foreach $p as $ps}
                                                <option value="{$ps['id']}" {if ($t['payeeid']) eq ($ps['id'])}selected="selected" {/if}>{$ps['account']}</option>
                                            {/foreach}


                                        </select>
                                        <input type="hidden" name="payer" id="payer" value="0">
                                    </div>
                                </div>
                            {/if}
                            <div class="form-group">
                                <label for="pmethod" class="col-sm-3 control-label">{$_L['Method']}</label>
                                <div class="col-sm-9">
                                    <select id="pmethod" name="pmethod" class="form-control">

                                        {foreach $pms as $pm}
                                            <option value="{$pm['name']}" {if $pm['name'] eq $t['method']}selected="selected" {/if}>{$pm['name']}</option>
                                        {/foreach}


                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ref" class="col-sm-3 control-label">{$_L['Ref']}#</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ref" name="ref" value="{$t['ref']}">
                                    <span class="help-block">{$_L['ref_example']}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="hidden" name="trid" id="trid" value="{$t['id']}">
                                <input type="hidden" id="trtype" name="trtype" value="{$t['type']}">
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-8">



            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Delete']}</h5>

                </div>
                <div class="ibox-content">

                    <p>{$_L['tr_delete_warning']}</p>
                    <form role="form" method="post" action="{$_url}transactions/delete-post/">





                        <input type="hidden" name="id" value="{$t['id']}">

                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {$_L['Delete']}</button>
                    </form>

                </div>
            </div>

            {if $t['attachments'] neq ''}
                <div class="ibox float-e-margins">

                    <div class="ibox-content">

                        {IBilling_Viewer::transaction_attachment($t['attachments'])}

                    </div>
                </div>
            {/if}

        </div>

    </div>

    <input type="hidden" id="_lan_no_results_found" value="{$_L['No results found']}">
{/block}

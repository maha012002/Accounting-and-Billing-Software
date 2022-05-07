{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row" id="ibox_form">

        <form id="invform" method="post">
            <div class="col-md-12">
                <div class="alert alert-danger" id="emsg">
                    <span id="emsgbody"></span>
                </div>
            </div>


            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="table-responsive m-t">
                            <table class="table invoice-table" id="invoice_items">
                                <thead>
                                <tr>
                                    <th width="10%">{$_L['Item Code']}</th>
                                    <th width="50%">{$_L['Item Name']}</th>
                                    <th width="10%">{$_L['Qty']}</th>
                                    <th width="10%">{$_L['Price']}</th>
                                    <th width="10%">{$_L['Total']}</th>
                                    <th width="10%">Tax</th>

                                </tr>
                                </thead>
                                <tbody>
                                {foreach $items as $item}
                                    <tr> <td>{$item['itemcode']}</td> <td><textarea class="form-control item_name" name="desc[]" rows="3">{$item['description']}</textarea> </td> <td><input type="text" class="form-control qty" value="{if ($_c['dec_point']) eq ','}{$item['qty']|replace:'.':','}{else}{$item['qty']}{/if}" name="qty[]"></td> <td><input type="text" class="form-control item_price" name="amount[]" value="{if ($_c['dec_point']) eq ','}{$item['amount']|replace:'.':','}{else}{$item['amount']}{/if}"></td> <td class="ltotal"><input type="text" class="form-control lvtotal" readonly="" value="{if ($_c['dec_point']) eq ','}{{$item['total']}|replace:'.':','}{else}{{$item['total']}}{/if}"></td> <td> <select class="form-control taxed" name="taxed[]"> <option value="Yes" {if $item['taxed'] eq '1'}selected=""{/if}>Yes</option> <option value="No" {if $item['taxed'] eq '0'}selected=""{/if}>No</option></select></td></tr>
                                {/foreach}


                                </tbody>
                            </table>

                        </div>
                        <!-- /table-responsive -->
                        <button type="button" class="btn btn-primary" id="blank-add"><i
                                    class="fa fa-plus"></i> {$_L['Add blank Line']}</button>
                        <button type="button" class="btn btn-primary" id="item-add"><i
                                    class="fa fa-search"></i> {$_L['Add Product OR Service']}</button>
                        <button type="button" class="btn btn-danger" id="item-remove"><i
                                    class="fa fa-minus-circle"></i> {$_L['Delete']}</button>
                        <br>
                        <br>
                        <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="{$_L['Invoice Terms']}...">{$i['notes']}</textarea>
                        <br>




                    </div>
                </div>



            </div>

            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="text-right">
                            <input type="hidden" name="iid" id="iid" value="{$i['id']}">
                            <input type="hidden" id="_dec_point" name="_dec_point" value="{$_c['dec_point']}">

                            <button class="btn btn-primary" id="submit"><i class="fa fa-save"></i> {$_L['Save Invoice']}
                            </button>
                            <button class="btn btn-info" id="save_n_close"><i class="fa fa-check"></i> {$_L['Save n Close']}</button>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table invoice-total">
                            <tbody>
                            <tr>
                                <td><strong>{$_L['Sub Total']} :</strong></td>
                                <td id="sub_total" class="amount">{$i['subtotal']}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>{$_L['Discount']} <span id="is_pt"></span> :</strong></td>
                                <td id="discount_amount_total" class="amount">{$i['discount']}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>{$_L['TAX']} :</strong></td>
                                <td id="taxtotal" class="amount">{$i['tax']}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>{$_L['TOTAL']} :</strong></td>
                                <td id="total" class="amount">{$i['total']}
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div>



                            <div class="form-group">
                                <label for="cid">{$_L['Customer']}</label>

                                <select id="cid" name="cid" class="form-control">
                                    <option value="">{$_L['Select Contact']}...</option>
                                    {foreach $c as $cs}
                                        <option value="{$cs['id']}"
                                                {if $i['userid'] eq ($cs['id'])}selected="selected" {/if}>{$cs['account']} {if $cs['email'] neq ''}- {$cs['email']}{/if}</option>
                                    {/foreach}

                                </select>
                                <span class="help-block"><a href="#"
                                                            id="contact_add">| {$_L['Or Add New Customer']}</a> </span>
                            </div>

                            <div class="form-group">
                                <label for="currency">{$_L['Currency']}</label>

                                <select id="currency" name="currency" class="form-control">

                                    {foreach $currencies as $currency}
                                        <option value="{$currency['id']}"
                                                {if $i['currency'] eq ($currency['id'])}selected="selected" {/if}>{$currency['cname']}</option>
                                        {foreachelse}
                                        <option value="0">{$_c['home_currency']}</option>
                                    {/foreach}

                                </select>

                            </div>



                            <div class="form-group">
                                <label for="address">{$_L['Address']}</label>

                                <textarea id="address" readonly class="form-control" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="invoicenum">{$_L['Invoice Prefix']}</label>

                                <input type="text" class="form-control" id="invoicenum" name="invoicenum">
                            </div>

                            <div class="form-group">
                                <label for="cn">{$_L['Invoice']} #</label>

                                <input type="text" class="form-control" id="cn" name="cn">
                                <span class="help-block">{$_L['invoice_number_help']}</span>
                            </div>

                            {if $i['r'] neq '0'}
                                <div class="form-group">
                                    <label for="repeat">{$_L['Repeat Every']}</label>

                                    <select class="form-control" name="repeat" id="repeat">
                                        <option value="week1" {if $i['r'] eq '+1 week'} selected{/if}>{$_L['Week']}</option>
                                        <option value="weeks2" {if $i['r'] eq '+2 weeks'} selected{/if}>{$_L['Weeks_2']}</option>
                                        <option value="month1" {if $i['r'] eq '+1 month'} selected{/if}>{$_L['Month']}</option>
                                        <option value="months2" {if $i['r'] eq '+2 months'} selected{/if}>{$_L['Months_2']}</option>
                                        <option value="months3" {if $i['r'] eq '+3 months'} selected{/if}>{$_L['Months_3']}</option>
                                        <option value="months6" {if $i['r'] eq '+6 months'} selected{/if}>{$_L['Months_6']}</option>
                                        <option value="year1" {if $i['r'] eq '+1 year'} selected{/if}>{$_L['Year']}</option>
                                        <option value="years2" {if $i['r'] eq '+2 years'} selected{/if}>{$_L['Years_2']}</option>
                                        <option value="years3" {if $i['r'] eq '+3 years'} selected{/if}>{$_L['Years_3']}</option>

                                    </select>
                                </div>
                            {else}
                                <input type="hidden" name="repeat" id="repeat" value="0">
                            {/if}

                            <div class="form-group">
                                <label for="idate">{$_L['Invoice Date']}</label>

                                <input type="text" class="form-control" id="idate" name="idate" datepicker
                                       data-date-format="yyyy-mm-dd" data-auto-close="true"
                                       value="{$i['date']}">
                            </div>
                            <div class="form-group">
                                <label for="duedate">{$_L['Payment Terms']}</label>

                                <input type="text" class="form-control" id="ddate" name="ddate" datepicker
                                       data-date-format="yyyy-mm-dd" data-auto-close="true"
                                       value="{$i['duedate']}">
                            </div>
                            <div class="form-group">
                                <label for="tid">{$_L['Sales TAX']}</label>

                                <select id="tid" name="tid" class="form-control">
                                    <option value="">None</option>
                                    {foreach $t as $ts}
                                        <option value="{$ts['id']}"
                                                {if $ts['name'] eq $i['taxname']}selected="selected" {/if} >{$ts['name']}
                                            ({{number_format($ts['rate'],2,$_c['dec_point'],$_c['thousands_sep'])}}
                                            %)
                                        </option>
                                    {/foreach}

                                </select>
                                <input type="hidden" id="stax" name="stax" value="{$i['taxrate']}">
                                <input type="hidden" id="discount_amount" name="discount_amount"
                                       value="{$i['discount_value']}">
                                <input type="hidden" id="discount_type" name="discount_type"
                                       value="{$i['discount_type']}">
                                <input type="hidden" id="taxed_type" name="taxed_type" value="individual">
                            </div>

                            <div class="form-group">
                                <label for="add_discount"><a href="#" id="add_discount" class="btn btn-info btn-xs"
                                                             style="margin-top: 5px;"><i
                                                class="fa fa-minus-circle"></i> {$_L['Set Discount']}</a></label>
                                <br>

                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </form>


    </div>

    {* lan variables *}

    <input type="hidden" id="_lan_set_discount" value="{$_L['Set Discount']}">
    <input type="hidden" id="_lan_discount" value="{$_L['Discount']}">
    <input type="hidden" id="_lan_discount_type" value="{$_L['Discount Type']}">
    <input type="hidden" id="_lan_percentage" value="{$_L['Percentage']}">
    <input type="hidden" id="_lan_fixed_amount" value="{$_L['Fixed Amount']}">
    <input type="hidden" id="_lan_btn_save" value="{$_L['Save']}">

    <input type="hidden" id="_lan_no_results_found" value="{$_L['No results found']}">

{/block}

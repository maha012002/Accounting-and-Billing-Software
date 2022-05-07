{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="wrapper wrapper-content">
        <div class="row">

            <div class="col-md-12">



                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{$_L['Add Contact']}</h5>

                        <a href="{$_url}contacts/import_csv/" class="btn btn-xs btn-primary btn-rounded pull-right"><i class="fa fa-bars"></i> Import Contacts</a>

                    </div>
                    <div class="ibox-content" id="ibox_form">
                        <div class="alert alert-danger" id="emsg">
                            <span id="emsgbody"></span>
                        </div>

                        <form class="form-horizontal" id="rform">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group"><label class="col-md-4 control-label" for="account">{$_L['Full Name']}<small class="red">*</small> </label>

                                        <div class="col-lg-8"><input type="text" id="account" name="account" class="form-control" autofocus>

                                        </div>
                                    </div>


                                    <div class="form-group"><label class="col-md-4 control-label" for="cid">{$_L['Company']}</label>

                                        <div class="col-lg-8">

                                            <select id="cid" name="cid" class="form-control">
                                                <option value="0">{$_L['None']}</option>
                                                {foreach $companies as $company}
                                                    <option value="{$company['id']}" {if $c_selected_id eq ($company['id'])}selected{/if}>{$company['company_name']}</option>
                                                {/foreach}
                                            </select>
                                            <span class="help-block"><a href="#" class="add_company"><i class="fa fa-plus"></i> {$_L['New Company']}</a> </span>

                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-md-4 control-label" for="email">{$_L['Email']}</label>

                                        <div class="col-lg-8"><input type="text" id="email" name="email" class="form-control">

                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-4 control-label" for="phone">{$_L['Phone']}</label>

                                        <div class="col-lg-8"><input type="text" id="phone" name="phone" class="form-control">

                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-4 control-label" for="address">{$_L['Address']}</label>

                                        <div class="col-lg-8"><input type="text" id="address" name="address" class="form-control">

                                        </div>
                                    </div>


                                    <div class="form-group"><label class="col-md-4 control-label" for="city">{$_L['City']}</label>

                                        <div class="col-lg-8"><input type="text" id="city" name="city" class="form-control">

                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-4 control-label" for="state">{$_L['State Region']}</label>

                                        <div class="col-lg-8"><input type="text" id="state" name="state" class="form-control">

                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-4 control-label" for="zip">{$_L['ZIP Postal Code']} </label>

                                        <div class="col-lg-8"><input type="text" id="zip" name="zip" class="form-control">

                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-md-4 control-label" for="country">{$_L['Country']}</label>

                                        <div class="col-lg-8">

                                            <select name="country" id="country" class="form-control">
                                                <option value="">{$_L['Select Country']}</option>
                                                {$countries}
                                            </select>

                                        </div>
                                    </div>

                                    {*run foreach*}

                                    {foreach $fs as $f}
                                        <div class="form-group"><label class="col-md-4 control-label" for="cf{$f['id']}">{$f['fieldname']}</label>
                                            {if ($f['fieldtype']) eq 'text'}


                                                <div class="col-lg-8">
                                                    <input type="text" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control">
                                                    {if ($f['description']) neq ''}
                                                        <span class="help-block">{$f['description']}</span>
                                                    {/if}

                                                </div>

                                            {elseif ($f['fieldtype']) eq 'password'}

                                                <div class="col-lg-8">
                                                    <input type="password" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control">
                                                    {if ($f['description']) neq ''}
                                                        <span class="help-block">{$f['description']}</span>
                                                    {/if}
                                                </div>

                                            {elseif ($f['fieldtype']) eq 'dropdown'}
                                                <div class="col-lg-8">
                                                    <select id="cf{$f['id']}" name="cf{$f['id']}" class="form-control">
                                                        {foreach explode(',',$f['fieldoptions']) as $fo}
                                                            <option value="{$fo}">{$fo}</option>
                                                        {/foreach}
                                                    </select>
                                                    {if ($f['description']) neq ''}
                                                        <span class="help-block">{$f['description']}</span>
                                                    {/if}
                                                </div>


                                            {elseif ($f['fieldtype']) eq 'textarea'}

                                                <div class="col-lg-8">
                                                    <textarea id="cf{$f['id']}" name="cf{$f['id']}" class="form-control" rows="3"></textarea>
                                                    {if ($f['description']) neq ''}
                                                        <span class="help-block">{$f['description']}</span>
                                                    {/if}
                                                </div>

                                            {else}
                                            {/if}
                                        </div>
                                    {/foreach}

                                    <div class="form-group"><label class="col-md-4 control-label" for="tags">{$_L['Tags']}</label>

                                        <div class="col-lg-8">
                                            {*<input type="text" id="tags" name="tags" style="width:100%">*}
                                            <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                                {foreach $tags as $tag}
                                                    <option value="{$tag['text']}">{$tag['text']}</option>
                                                {/foreach}

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">


                                    <div class="form-group"><label class="col-md-4 control-label" for="currency">{$_L['Currency']}</label>

                                        <div class="col-lg-8">
                                            <select id="currency" name="currency" class="form-control">

                                                {foreach $currencies as $currency}
                                                    <option value="{$currency['id']}"
                                                            {if $_c['home_currency'] eq ($currency['cname'])}selected="selected" {/if}>{$currency['cname']}</option>
                                                    {foreachelse}
                                                    <option value="0">{$_c['home_currency']}</option>
                                                {/foreach}

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-md-4 control-label" for="group">{$_L['Group']}</label>

                                        <div class="col-lg-8">
                                            <select class="form-control" name="group" id="group">
                                                <option value="0">{$_L['None']}</option>
                                                {foreach $gs as $g}
                                                    <option value="{$g['id']}" {if $g_selected_id eq ($g['id'])}selected{/if}>{$g['gname']}</option>
                                                {/foreach}
                                            </select>
                                            <span class="help-block"><a href="#" id="add_new_group">{$_L['Add New Group']}</a> </span>
                                        </div>
                                    </div>


                                    <div class="form-group"><label class="col-md-4 control-label" for="password">{$_L['Password']}</label>

                                        <div class="col-lg-8"><input type="password" id="password" name="password" class="form-control">

                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-md-4 control-label" for="cpassword">{$_L['Confirm Password']}</label>

                                        <div class="col-lg-8"><input type="password" id="cpassword" name="cpassword" class="form-control">

                                        </div>
                                    </div>


                                    <div class="form-group"><label class="col-md-4 control-label" for="send_client_signup_email">{$_L['Welcome Email']}</label>

                                        <div class="col-lg-8">


                                            <input type="checkbox" checked data-toggle="toggle" data-size="small" data-on="{$_L['Yes']}" data-off="{$_L['No']}" id="send_client_signup_email" name="send_client_signup_email" value="Yes">


                                            <span class="help-block">{$_L['Send Client Signup Email']}</span>

                                        </div>
                                    </div>



                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-lg-10">

                                            <button class="md-btn md-btn-primary waves-effect waves-light" type="submit" id="submit"><i class="fa fa-check"></i> {$_L['Save']}</button> | <a href="{$_url}contacts/list/">{$_L['Or Cancel']}</a>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <input type="hidden" name="_msg_add_new_group" id="_msg_add_new_group" value="{$_L['Add New Group']}">
    <input type="hidden" name="_msg_group_name" id="_msg_group_name" value="{$_L['Group Name']}">


{/block}

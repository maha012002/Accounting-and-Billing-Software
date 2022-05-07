{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-{if $extra_panel eq ''}12{else}6{/if}">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$d['name']}</h5>

                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                    <form class="form-horizontal" method="post" id="pg-conf" role="form">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">{$_L['Name']}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="{$d['name']}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="value" class="col-sm-3 control-label">


                                {$label['value']}



                            </label>
                            <div class="col-sm-9">



                                {$input['value']}
                                {if ($help_txt['value']) neq ''}
                                    <span class="help-block">{$help_txt['value']}</span>
                                {/if}
                            </div>
                        </div>





                        {if ($label['c1']) neq ''}
                            <div class="form-group">
                                <label for="c1" class="col-sm-3 control-label"> {$label['c1']} </label>
                                <div class="col-sm-9">
                                    {$input['c1']}
                                    {if ($help_txt['c1']) neq ''}
                                        <span class="help-block">{$help_txt['c1']}</span>
                                    {/if}
                                </div>
                            </div>
                        {/if}

                        {if ($label['c2']) neq ''}

                            <div class="form-group">
                                <label for="c2" class="col-sm-3 control-label">{$label['c2']}</label>
                                <div class="col-sm-9">
                                    {$input['c2']}
                                    {if ($help_txt['c2']) neq ''}
                                        <span class="help-block">{$help_txt['c2']}</span>
                                    {/if}
                                </div>
                            </div>

                        {/if}


                        {if ($label['c3']) neq ''}

                            <div class="form-group">
                                <label for="c3" class="col-sm-3 control-label">{$label['c3']}</label>
                                <div class="col-sm-9">
                                    {$input['c3']}
                                    {if ($help_txt['c3']) neq ''}
                                        <span class="help-block">{$help_txt['c3']}</span>
                                    {/if}
                                </div>
                            </div>

                        {/if}



                        {if ($label['c4']) neq ''}

                            <div class="form-group">
                                <label for="c4" class="col-sm-3 control-label">{$label['c4']}</label>
                                <div class="col-sm-9">
                                    {$input['c4']}
                                    {if ($help_txt['c4']) neq ''}
                                        <span class="help-block">{$help_txt['c4']}</span>
                                    {/if}
                                </div>
                            </div>

                        {/if}



                        {if ($label['c5']) neq ''}
                            <div class="form-group">
                                <label for="c5" class="col-sm-3 control-label">{$label['c5']}</label>
                                <div class="col-sm-9">
                                    {$input['c5']}
                                    {if ($help_txt['c5']) neq ''}
                                        <span class="help-block">{$help_txt['c5']}</span>
                                    {/if}
                                </div>
                            </div>
                        {/if}


                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">{$_L['Status']}</label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {if $d['status'] eq 'Active'}selected="selected" {/if}>{$_L['Active']}</option>
                                    <option value="Inactive" {if $d['status'] eq 'Inactive'}selected="selected" {/if}>{$_L['Inactive']}</option>

                                </select>



                            </div>
                        </div>


                        {if ($label['mode'])}

                            <div class="form-group">
                                <label for="mode" class="col-sm-3 control-label">{$_L['Mode']}</label>
                                <div class="col-sm-9">
                                    <select name="mode" id="mode" class="form-control">
                                        <option value="Live" {if $d['mode'] eq 'Live'}selected="selected" {/if}>{$_L['Live']}</option>
                                        <option value="Sandbox" {if $d['mode'] eq 'Sandbox'}selected="selected" {/if}>{$_L['Sandbox']}</option>

                                    </select>

                                    {if ($help_txt['mode']) neq ''}
                                        <span class="help-block">{$help_txt['mode']}</span>
                                    {/if}

                                </div>
                            </div>

                        {/if}



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="hidden" name="pgid" id="pgid" value="{$d['id']}">
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                                | {$_L['Or']} <a href="{$_url}settings/pg/"> {$_L['Back To The List']}</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>


        {if $extra_panel neq ''}
            <div class="col-md-6">
                {$extra_panel}
            </div>
        {/if}

    </div>




{/block}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {if $f_type eq 'edit'}
            {$_L['Edit']}
        {else}
            {$_L['New Company']}
        {/if}
    </h3>
</div>
<div class="modal-body">

    <form class="form-horizontal" id="ib_modal_form">

        <div class="form-group"><label class="col-lg-4 control-label" for="company_name">{$_L['Company Name']}<small class="red">*</small></label>

            <div class="col-lg-8"><input type="text" id="company_name" name="company_name" class="form-control" value="{$val['company_name']}">

            </div>


        </div>


        <div class="form-group"><label class="col-lg-4 control-label" for="url">{$_L['URL']}</label>

            <div class="col-lg-8"><input type="text" id="url" name="url" class="form-control" value="{$val['url']}">

            </div>


        </div>


        <div class="form-group"><label class="col-lg-4 control-label" for="email">{$_L['Email']}</label>

            <div class="col-lg-8"><input type="text" id="email" name="email" class="form-control" value="{$val['email']}">

            </div>


        </div>


        <div class="form-group"><label class="col-lg-4 control-label" for="phone">{$_L['Phone']}</label>

            <div class="col-lg-8"><input type="text" id="phone" name="phone" class="form-control" value="{$val['phone']}">

            </div>


        </div>


        <div class="form-group"><label class="col-lg-4 control-label" for="logo_url">{$_L['Logo URL']}</label>

            <div class="col-lg-8"><input type="text" id="logo_url" name="logo_url" class="form-control" value="{$val['logo_url']}">

            </div>


        </div>






        <input type="hidden" name="f_type" id="f_type" value="{$f_type}">
        <input type="hidden" name="cid" id="cid" value="{$val['cid']}">
    </form>

</div>
<div class="modal-footer">



    <button type="button" data-dismiss="modal" class="btn btn-danger">{$_L['Cancel']}</button>
    <button class="btn btn-primary modal_submit" type="submit" id="modal_submit"><i class="fa fa-check"></i> {$_L['Save']}</button>
</div>

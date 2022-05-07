{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">

                    <h3 class="text-primary">{$doc->title}</h3>
                    <hr>

                    <a href="{$_url}client/dl/{$doc->id}_{$doc->file_dl_token}" class="md-btn md-btn-primary waves-effect waves-light"><i class="fa fa-download"></i>  {$_L['Download']} </a>

                    {if has_access($user->roleid,'documents','delete')}
                        <a href="{$_url}delete/document/{$doc->id}/" class="md-btn md-btn-danger waves-effect waves-light"><i class="fa fa-trash"></i>  {$_L['Delete']} </a>
                    {/if}


                    <hr>

                    {if $ext eq 'jpg' || $ext eq 'png' || $ext eq 'gif'}
                        <img src="{$app_url}application/storage/docs/{$doc->file_path}" class="img-responsive" alt="{$doc->title}">
                    {/if}





                </div>
            </div>
        </div>



    </div>

{/block}

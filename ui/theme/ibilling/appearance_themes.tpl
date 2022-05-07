{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Themes']}</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="accadd" method="post" action="{$_url}appearance/themes_post/">


                        <div class="form-group">
                            <label for="theme">{$_L['Theme']}</label>
                            <select name="theme" id="theme" class="form-control">

                                {foreach $themes|default:array() as $theme}
                                    <option value="{$theme}"
                                            {if $_c['theme'] eq $theme}selected="selected" {/if}>{ucfirst($theme)}</option>
                                {/foreach}

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nstyle">{$_L['Style']}</label>
                            <select name="nstyle" id="nstyle" class="form-control">
                                <option value="dark" {if $_c['nstyle'] eq 'dark'}selected="selected" {/if}>Dark</option>
                                <option value="light" {if $_c['nstyle'] eq 'light'}selected="selected" {/if}>Light</option>
                                <option value="blue" {if $_c['nstyle'] eq 'blue'}selected="selected" {/if}>Blue</option>
                                <option value="dark_extra" {if $_c['nstyle'] eq 'dark_extra'}selected="selected" {/if}>Dark extra</option>
                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                    </form>

                </div>
            </div>










        </div>




    </div>


{/block}

<div id="ajax-modal" class="modal container fade-scale" tabindex="-1" style="display: none;"></div>
</div>

{if $tpl_footer}
    {if $_c['hide_footer']}

        {else}
        <div class="footer">
            <div>
                <strong>{$_L['Copyright']}</strong> &copy; {$_c['CompanyName']}
            </div>
        </div>
    {/if}
{/if}

</div>

<div id="right-sidebar">
    <div class="sidebar-container">

        <ul class="nav nav-tabs navs-3">

            <li class="active"><a data-toggle="tab" href="#tab-1">
                    {$_L['Notes']}
                </a></li>

            <li class=""><a data-toggle="tab" href="#tab-3">
                    <i class="fa fa-gear"></i>
                </a></li>
        </ul>

        <div class="tab-content">


            <div id="tab-1" class="tab-pane active">

                <div class="sidebar-title">
                    <h3> <i class="fa fa-file-text-o"></i> {$_L['Quick Notes']}</h3>

                </div>

                <div style="padding: 10px">

                    <form class="form-horizontal push-10-t push-10" method="post" onsubmit="return false;">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material floating">
                                    <textarea class="form-control" id="ib_admin_notes" name="ib_admin_notes" rows="10">{$user->notes}</textarea>
                                    <label for="ib_admin_notes">{$_L['Whats on your mind']}</label>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-sm btn-success" type="submit" id="ib_admin_notes_save"><i class="fa fa-check"></i> {$_L['Save']}</button>
                            </div>
                        </div>
                    </form>
                    </div>




            </div>


            <div id="tab-3" class="tab-pane">

                <div class="sidebar-title">
                    <h3><i class="fa fa-gears"></i> {$_L['Settings']}</h3>

                </div>

                <div class="setings-item">
                    <h4>{$_L['Theme_Color']}</h4>

                    <ul id="ib_theme_color" class="ib_theme_color">

                        <li><a href="{$_url}settings/set_color/light/"><span class="light"></span></a></li>
                        <li><a href="{$_url}settings/set_color/blue/"><span class="blue"></span></a></li>
                        <li><a href="{$_url}settings/set_color/dark/"><span class="dark"></span></a></li>
                    </ul>


                </div>
                <div class="setings-item">
                    <span>
                        {$_L['Fold Sidebar Default']}
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="r_fold_sidebar" {if get_option('mininav') eq '1'}checked{/if} class="onoffswitch-checkbox" id="r_fold_sidebar">
                            <label class="onoffswitch-label" for="r_fold_sidebar">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>



</div>

</div>
</section>
<!-- BEGIN PRELOADER -->
{if ($_c['animate']) eq '1'}
    <div class="loader-overlay">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
{/if}
<input type="hidden" id="_url" name="_url" value="{$_url}">
<input type="hidden" id="_df" name="_df" value="{$_c['df']}">
<input type="hidden" id="_lan" name="_lan" value="{$_c['language']}">
<!-- END PRELOADER -->
<!-- Mainly scripts -->


<script>
    var _L = [];


    var app_url = '{$app_url}';
    var base_url = '{$base_url}';

    {if ($_c['animate']) eq '1'}
    var config_animate = 'Yes';
    {else}
    var config_animate = 'No';
    {/if}
    {$jsvar}
</script>

<script src="{$app_url}ui/lib/ibilling.js"></script>



{if isset($xfooter)}
    {$xfooter}
{/if}

{block name=script}{/block}

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins

        matForms();



        {if isset($xjq)}
        {$xjq}
        {/if}

    });

</script>
</body>

</html>

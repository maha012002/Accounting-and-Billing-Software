<div id="ajax-modal" class="modal container fade" tabindex="-1" style="display: none;"></div>
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
<script src="{$_theme}/js/jquery-1.10.2.js"></script>
<script src="{$_theme}/js/jquery-ui-1.10.4.min.js"></script>
<script>
    var _L = [];
    var config_animate = 'No';
    {if ($_c['animate']) eq '1'}
    var config_animate = 'Yes';
    {/if}
    {$jsvar}
</script>
<script src="{$_theme}/js/bootstrap.min.js"></script>
<script src="{$_theme}/js/jquery.metisMenu.js"></script>
<script src="{$_theme}/js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="{$_theme}/lib/moment.js"></script>
<script src="{$app_url}/ui/lib/blockui.js"></script>
<script src="{$app_url}/ui/lib/toggle/bootstrap-toggle.min.js"></script>

<script src="{$app_url}/ui/lib/numeric.js"></script>

<script src="{$app_url}/ui/lib/app.js"></script>

<script src="{$_theme}/js/theme.js"></script>

{if ($_c['animate']) eq '1'}
    <script src="{$_theme}/js/pace.min.js"></script>
{/if}
<script src="{$_theme}/lib/progress.js"></script>
<script src="{$_theme}/lib/bootbox.min.js"></script>

<!-- iCheck -->
<script src="{$_theme}/lib/icheck/icheck.min.js"></script>
{if isset($xfooter)}
    {$xfooter}
{/if}
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins

        matForms();

        {if isset($xjq)}
        {$xjq}
        {/if}

    });

</script>
{$_c['footer_scripts']}
</body>

</html>

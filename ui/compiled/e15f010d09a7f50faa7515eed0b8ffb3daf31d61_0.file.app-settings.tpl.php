<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:54:41
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/app-settings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3ab012ee315_05502670',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e15f010d09a7f50faa7515eed0b8ffb3daf31d61' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/app-settings.tpl',
      1 => 1621337997,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3ab012ee315_05502670 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89329580760a3ab012d9102_05677799', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_89329580760a3ab012d9102_05677799 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_89329580760a3ab012d9102_05677799',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['General Settings'];?>
</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="accadd" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app-post">
                        <div class="form-group">
                            <label for="company"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Application Name'];?>
</label>
                            <input type="text" class="form-control" id="company" name="company"
                                   value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
">
                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['_L']->value['This Name will be'];?>
</span>
                        </div>



                        <div class="form-group">
                            <label for="default_landing_page"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Default Landing Page'];?>
</label>
                            <select name="default_landing_page" id="default_landing_page" class="form-control">
                                <option value="login"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['default_landing_page'] == 'login') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Admin Login'];?>
</option>
                                <option value="client/login"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['default_landing_page'] == 'client/login') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Client Login'];?>
</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="opt_dashboard"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Dashboard'];?>
</label>
                            <select name="dashboard" id="opt_dashboard" class="form-control">
                                <option value="canvas"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['dashboard'] == 'canvas') {?>selected="selected" <?php }?>>Canvas</option>
                                <option value="legacy"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['dashboard'] == 'legacy') {?>selected="selected" <?php }?>>Legacy</option>


                            </select>
                        </div>





                        <hr>

                        <div class="form-group">
                            <label for="caddress"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Pay To Address'];?>
</label>

                            <textarea class="form-control" id="caddress" name="caddress"
                                      rows="3"><?php echo $_smarty_tpl->tpl_vars['_c']->value['caddress'];?>
</textarea>
                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['_L']->value['You can use html tag'];?>
</span>
                        </div>

                        <div class="form-group">

                            <label for="invoice_terms"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Default Invoice Terms'];?>
</label>

                            <textarea class="form-control" id="invoice_terms" name="invoice_terms"
                                      rows="3"><?php echo $_smarty_tpl->tpl_vars['_c']->value['invoice_terms'];?>
</textarea>

                        </div>

                        <div class="form-group">
                            <label for="iai"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Starting'];?>
 #</label>
                            <input type="text" class="form-control" id="iai" name="iai">
                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Enter to set the next invoice'];?>

                                - <strong><?php echo $_smarty_tpl->tpl_vars['ai']->value;?>
</strong> (<?php echo $_smarty_tpl->tpl_vars['_L']->value['Keep Blank for'];?>
)</span>
                        </div>

                        <div class="form-group">
                            <label for="pdf_font"><?php echo $_smarty_tpl->tpl_vars['_L']->value['PDF Font'];?>
</label>
                            <select name="pdf_font" id="pdf_font" class="form-control">
                                <option value="default" <?php if ($_smarty_tpl->tpl_vars['_c']->value['pdf_font'] == 'default') {?>selected="selected" <?php }?>>Default
                                    [Faster PDF Creation with Less Memory]
                                </option>
                                <option value="Helvetica" <?php if ($_smarty_tpl->tpl_vars['_c']->value['pdf_font'] == 'Helvetica') {?>selected="selected" <?php }?>>
                                    Helvetica
                                </option>
                                <option value="dejavusanscondensed"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['pdf_font'] == 'dejavusanscondensed') {?>selected="selected" <?php }?>>
                                    dejavusanscondensed [Embed fonts with supports UTF8]
                                </option>

                                <option value="AdobeCJK" <?php if ($_smarty_tpl->tpl_vars['_c']->value['pdf_font'] == 'AdobeCJK') {?>selected="selected" <?php }?>>
                                    AdobeCJK [Adobe Asian Font pack]
                                </option>

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="i_driver"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Creation Method'];?>
</label>
                            <select name="i_driver" id="i_driver" class="form-control">
                                <option value="default"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['i_driver'] == 'default') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Legacy'];?>
</option>
                                <option value="v2"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['i_driver'] == 'v2') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['New'];?>
</option>


                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
</button>
                    </form>

                </div>
            </div>







            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Google reCAPTCHA</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="accadd" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/recaptcha_post/">

                        <div class="form-group">
                            <label for="recaptcha"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Enable Recaptcha'];?>
</label>
                            <select name="recaptcha" id="recaptcha" class="form-control">
                                <option value="1"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['recaptcha'] == '1') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Yes'];?>
</option>
                                <option value="0"
                                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['recaptcha'] == '0') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['No'];?>
</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recaptcha_sitekey"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Recaptcha'];?>
 <?php echo $_smarty_tpl->tpl_vars['_L']->value['Site Key'];?>
</label>
                            <input type="text" class="form-control" id="recaptcha_sitekey" name="recaptcha_sitekey" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['recaptcha_sitekey'];?>
">

                        </div>

                        <div class="form-group">
                            <label for="recaptcha_secretkey"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Recaptcha'];?>
 <?php echo $_smarty_tpl->tpl_vars['_L']->value['Secret Key'];?>
</label>
                            <input type="text" class="form-control" id="recaptcha_secretkey" name="recaptcha_secretkey" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['recaptcha_secretkey'];?>
">

                        </div>



                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
</button>
                    </form>

                </div>
            </div>




            <div class="ibox float-e-margins" id="additional_settings">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Additional Settings'];?>
</h5>


                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <tbody>

                        <tr>
                            <td width="80%"><label for="url_rewrite"><?php echo $_smarty_tpl->tpl_vars['_L']->value['URL Rewrite'];?>
 </label>
                                <br>
                                <p>Please do not enable this, unless you are sure.</p>
                            </td>
                            <td><input type="checkbox" <?php if (get_option('url_rewrite') == '1') {?>checked<?php }?>
                                       data-toggle="toggle" data-size="small" data-on="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Yes'];?>
" data-off="<?php echo $_smarty_tpl->tpl_vars['_L']->value['No'];?>
"
                                       id="url_rewrite"></td>
                        </tr>

                        <tr>
                            <td width="80%"><label
                                        for="console_notify_invoice_created"><?php echo $_smarty_tpl->tpl_vars['_L']->value['cron_invoice_created'];?>
 </label></td>
                            <td><input type="checkbox" <?php if (get_option('console_notify_invoice_created') == '1') {?>checked<?php }?>
                                       data-toggle="toggle" data-size="small" data-on="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Yes'];?>
" data-off="<?php echo $_smarty_tpl->tpl_vars['_L']->value['No'];?>
"
                                       id="console_notify_invoice_created"></td>
                        </tr>


                        </tbody>
                    </table>


                </div>
            </div>


        </div>


    </div>


<?php
}
}
/* {/block "content"} */
}

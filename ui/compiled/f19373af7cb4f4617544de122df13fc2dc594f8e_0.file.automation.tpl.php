<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:54:51
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/automation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3ab0b829ee0_83290746',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f19373af7cb4f4617544de122df13fc2dc594f8e' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/automation.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3ab0b829ee0_83290746 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_88292513660a3ab0b820422_31668446', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_88292513660a3ab0b820422_31668446 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_88292513660a3ab0b820422_31668446',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Automation'];?>
</h5>

                </div>
                <div class="ibox-content">

                    <form class="form-horizontal" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/consolekey_regen/">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Security Token'];?>
</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ckey" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['ckey'];?>
" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Re Generate Key'];?>
</button>
                            </div>
                        </div>
                    </form>

                    <p><?php echo $_smarty_tpl->tpl_vars['_L']->value['to_enable_automation'];?>
</p>
                    <br>
                    <p class="text-primary text-center"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Create the following Cron Job using GET'];?>
</p>
                    <input type="text" class="form-control" value="GET <?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
console/<?php echo $_smarty_tpl->tpl_vars['_c']->value['ckey'];?>
/">
                    <h3 class="text-primary text-center"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Or'];?>
</h3>
                    <p class="text-primary text-center"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Create the following Cron Job using PHP'];?>
</p>
                    <input type="text" class="form-control" value="php-cgi -f <?php echo getcwd();?>
/index.php a=CLI ng=console/<?php echo $_smarty_tpl->tpl_vars['_c']->value['ckey'];?>
/">
                    <h3 class="text-primary text-center"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Or'];?>
</h3>
                    <p class="text-primary text-center"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Create the following Cron Job using WGET'];?>
</p>
                    <input type="text" class="form-control" value="WGET '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
console/<?php echo $_smarty_tpl->tpl_vars['_c']->value['ckey'];?>
/'">
                    <hr>
                    <h3><?php echo $_smarty_tpl->tpl_vars['_L']->value['Settings'];?>
</h3>
                    <hr>
                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/automation-post/">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="sys_csw" name="accounting_snapshot" value="on" <?php if (($_smarty_tpl->tpl_vars['arcs']->value['accounting_snapshot']) == 'Active') {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Generate Daily Accounting Snapshot'];?>

                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="sys_csw" name="recurring_invoice" value="on" <?php if (($_smarty_tpl->tpl_vars['arcs']->value['recurring_invoice']) == 'Active') {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Generate Recurring Invoices'];?>

                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="sys_csw" name="notify" value="on" <?php if (($_smarty_tpl->tpl_vars['arcs']->value['notify']) == 'Active') {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Enable Email Notifications'];?>

                            </label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Send Notifications To'];?>
: </label>
                            <input type="email" class="form-control" id="notifyemail" name="notifyemail" value="<?php echo $_smarty_tpl->tpl_vars['arcs']->value['notifyemail'];?>
">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Save Changes'];?>
</button>
                    </form>
                </div>
            </div>



        </div>



    </div>


<?php
}
}
/* {/block "content"} */
}

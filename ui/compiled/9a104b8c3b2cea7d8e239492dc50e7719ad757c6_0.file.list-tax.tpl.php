<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:54:48
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/list-tax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3ab080bc937_27072886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a104b8c3b2cea7d8e239492dc50e7719ad757c6' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/list-tax.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3ab080bc937_27072886 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_93247536160a3ab080b30c8_75079837', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_93247536160a3ab080b30c8_75079837 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_93247536160a3ab080b30c8_75079837',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sales Taxes'];?>
 </h5>
        </div>
        <div class="ibox-content">
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/add-tax/" id="item_add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Tax'];?>
 </a>
            <table class="table table-bordered table-hover sys_table">
                <thead>
                <tr>
                    <th width="70%"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</th>
                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Tax Rate'];?>
</th>

                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
                </tr>
                </thead>
                <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                    <tr id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
">
                        <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['name'];?>
</td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['ib_money_format_apply']->value) {?>
                                <?php echo ib_money_format($_smarty_tpl->tpl_vars['ds']->value['rate'],$_smarty_tpl->tpl_vars['_c']->value);?>

                            <?php } else { ?>
                                <?php echo $_smarty_tpl->tpl_vars['ds']->value['rate']+0;?>

                            <?php }?>

                        </td>
                        <td>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/edit-tax/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-info btn-xs edit"><i class="fa fa-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
 </a>
                            <button type="button" id="t<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" class="btn btn-danger btn-xs cdelete"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
 </button>
                        </td>

                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                </tbody>
            </table>
            <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

        </div>
    </div>
    <input type="hidden" id="_lan_are_you_sure" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
">


<?php
}
}
/* {/block "content"} */
}

<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:54:49
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/customfields.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3ab0955f8f0_32712053',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '84900936006b6fc5941828b094a0f695139cf3bc' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/customfields.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3ab0955f8f0_32712053 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_35237278260a3ab0954f6e4_41128252', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_35237278260a3ab0954f6e4_41128252 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_35237278260a3ab0954f6e4_41128252',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">


        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Custom Fields'];?>
</h5>

                </div>
                <div class="ibox-content" id="application_ajaxrender">

                    <form class="form-horizontal" id="rform">

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cf']->value, 'c');
$_smarty_tpl->tpl_vars['c']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->do_else = false;
?>
                            <div class="form-group">
                                <label class="col-lg-4 control-label" for="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['fieldname'];?>
</label>
                                <?php if (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'text') {?>

                                    <div class="col-lg-4">
                                        <input type="text" id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" name="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control">
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>

                                <?php } elseif (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'password') {?>

                                    <div class="col-lg-4">
                                        <input type="password" id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" name="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control">
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>

                                <?php } elseif (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'dropdown') {?>
                                    <div class="col-lg-4">
                                        <select id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, explode(',',$_smarty_tpl->tpl_vars['c']->value['fieldoptions']), 'fo');
$_smarty_tpl->tpl_vars['fo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fo']->value) {
$_smarty_tpl->tpl_vars['fo']->do_else = false;
?>
                                                <option><?php echo $_smarty_tpl->tpl_vars['fo']->value;?>
</option>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>


                                <?php } elseif (($_smarty_tpl->tpl_vars['c']->value['fieldtype']) == 'textarea') {?>

                                    <div class="col-lg-4">
                                        <textarea id="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" name="cf<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
" class="form-control" rows="3"></textarea>
                                        <?php if (($_smarty_tpl->tpl_vars['c']->value['description']) != '') {?>
                                            <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['c']->value['description'];?>
</span>
                                        <?php }?>
                                    </div>

                                <?php } else { ?>

                                <?php }?>
                                <div class="col-lg-4"><a href="#" class="btn btn-primary sys_edit" id="f<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><i class="fa fa-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
</a>

                                    <a href="#" class="btn btn-danger cdelete" id="d<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
</a>


                                </div>
                            </div>
                            <?php
}
if ($_smarty_tpl->tpl_vars['c']->do_else) {
?>

                            <h4 class="muted text-center"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Custom Fields Not Available'];?>
</h4>

                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <p class=" text-center"><a href="" class="btn btn-outline btn-success sys_add"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Custom Field'];?>
</a></p>


                    </form>

                </div>
            </div>



        </div>


    </div>


    <input type="hidden" id="_lan_are_you_sure" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
">


<?php
}
}
/* {/block "content"} */
}

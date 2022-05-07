<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:53:52
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/crm_groups.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3aad0dadf16_94844038',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2dcf5bee05f7ae1834dda0768be51776dcd31506' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/crm_groups.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3aad0dadf16_94844038 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_73863924760a3aad0da45e6_00726528', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_73863924760a3aad0da45e6_00726528 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_73863924760a3aad0da45e6_00726528',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Groups'];?>
</h5>

                </div>
                <div class="ibox-content">
                    <a href="#" class="btn btn-success" id="add_new_group"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add New Group'];?>
</a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reorder/groups/" class="btn btn-primary"><i class="fa fa-download"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Reorder'];?>
</a>

                    <br>
                    <br>
                    <table class="table table-striped table-bordered">
                        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Group'];?>
</th>
                        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gs']->value, 'g');
$_smarty_tpl->tpl_vars['g']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['g']->value) {
$_smarty_tpl->tpl_vars['g']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['g']->value['gname'];?>
</td>

                                <td>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/find_by_group/<?php echo $_smarty_tpl->tpl_vars['g']->value['id'];?>
/" class="btn btn-xs btn-primary"><i class="fa fa-bars"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['List Contacts'];?>
</a>
                                    <a href="#" class="btn btn-xs btn-warning edit_group" id="e<?php echo $_smarty_tpl->tpl_vars['g']->value['id'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['g']->value['gname'];?>
"><i class="fa fa-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
</a>

                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/users-delete/<?php echo $_smarty_tpl->tpl_vars['g']->value['id'];?>
" id="g<?php echo $_smarty_tpl->tpl_vars['g']->value['id'];?>
" class="btn btn-xs btn-danger cdelete"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
</a>

                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


                    </table>

                </div>
            </div>



        </div>



    </div>



    <input type="hidden" name="_msg_add_new_group" id="_msg_add_new_group" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Add New Group'];?>
">
    <input type="hidden" name="_msg_group_name" id="_msg_group_name" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Group Name'];?>
">
    <input type="hidden" name="_msg_edit" id="_msg_edit" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
">
    <input type="hidden" name="_msg_ok" id="_msg_ok" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['OK'];?>
">
    <input type="hidden" name="_msg_cancel" id="_msg_cancel" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Cancel'];?>
">


<?php
}
}
/* {/block "content"} */
}

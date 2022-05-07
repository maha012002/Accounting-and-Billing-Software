<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:53:53
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/companies.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3aad1ee9ea2_95063509',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85066ed6598c10d265fadd6945016a2d6390209e' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/companies.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3aad1ee9ea2_95063509 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_207227438060a3aad1ee0010_85822801', "content");
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_207227438060a3aad1ee0010_85822801 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_207227438060a3aad1ee0010_85822801',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="#" class="btn btn-primary add_company waves-effect waves-light" id="add_company"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['New Company'];?>
</a>


                </div>

            </div>
        </div>



    </div>

    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">



                    <div class="table-responsive" id="ib_data_table">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Logo'];?>
</th>
                                <th class="bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Company Name'];?>
</th>
                                <th class="bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
</th>
                                <th class="bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Phone'];?>
</th>
                                <th class="text-center bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['companies']->value, 'company');
$_smarty_tpl->tpl_vars['company']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
$_smarty_tpl->tpl_vars['company']->do_else = false;
?>
                                <tr data-id="<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
">
                                    <td>

                                        <?php if ($_smarty_tpl->tpl_vars['company']->value['logo_url'] != '') {?>
                                            <img style="max-height: 40px;" src="<?php echo $_smarty_tpl->tpl_vars['company']->value['logo_url'];?>
">
                                        <?php } else { ?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/ui/theme/ibilling/img/default_company.png">
                                        <?php }?>

                                    </td>
                                    <td> <a class="cview" id="ae<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
</a>
                                    </td>
                                    <td><a href="#" class="send_email"><?php echo $_smarty_tpl->tpl_vars['company']->value['email'];?>
</a> </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['company']->value['phone'];?>
</td>
                                    <td class="text-right">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
" id="be<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
" class="btn btn-inverse btn-xs cedit" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
"><i class="fa fa-pencil"></i> </a>


                                        <a href="#" class="btn btn-danger btn-xs cdelete" id="c<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
"><i class="fa fa-trash"></i> </a>
                                    </td>

                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>






                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary waves-effect waves-light add_company" href="#">
            <i class="fa fa-plus"></i>
        </a>
    </div>
<?php
}
}
/* {/block "content"} */
}

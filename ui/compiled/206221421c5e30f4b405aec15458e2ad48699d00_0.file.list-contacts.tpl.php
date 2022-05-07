<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:53:52
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/list-contacts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3aad0360087_09518283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '206221421c5e30f4b405aec15458e2ad48699d00' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/list-contacts.tpl',
      1 => 1621338336,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3aad0360087_09518283 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_120762205260a3aad033bf25_71482752', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_120762205260a3aad033bf25_71482752 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_120762205260a3aad033bf25_71482752',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ($_smarty_tpl->tpl_vars['_c']->value['contact_set_view_mode'] == 'search') {?>

        <div class="row">



            <div class="col-md-12">



                <div class="panel panel-default">
                    <div class="panel-body">

                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/add/" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Customer'];?>
</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/import_csv/" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Import'];?>
</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/export_csv/" class="btn btn-info"><i class="fa fa-download"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Export'];?>
</a>

                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list/">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" name="name" id="foo_filter" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Search'];?>
..."/>

                                    </div>
                                </div>

                            </div>
                        </form>

                        <table class="table table-bordered table-hover sys_table footable"  data-filter="#foo_filter" data-page-size="50">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th data-sort-ignore="true"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Image'];?>
</th>
                                <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</th>
                                <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Company Name'];?>
</th>
                                <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
</th>
                                <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Phone'];?>
</th>
                                <th class="text-right" data-sort-ignore="true"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
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

                                <tr>

                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
</a> </td>
                                    <td class="text-center">


                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['img'] == 'gravatar') {?>
                                            <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['ds']->value['email']));?>
?s=32" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['ds']->value['lname'];?>
">
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['img'] == '') {?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/theme/ibilling/img/contact_blank_32.png" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['ds']->value['lname'];?>
">
                                        <?php } else { ?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['ds']->value['img'];?>
" class="img-thumbnail img-responsive" style="max-height: 32px;" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
">
                                        <?php }?>

                                    </td>

                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</a> </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['company'];?>
</td>

                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['ds']->value['email'];?>


                                    </td>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['ds']->value['phone'];?>

                                    </td>
                                    <td class="text-right">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-primary btn-xs"><i class="fa fa-search"></i> </a>

                                        <a href="delete/crm-user/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-danger btn-xs cdelete" id="uid<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
"><i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>

                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <ul class="pagination">
                                    </ul>
                                </td>
                            </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>






        </div>



















    <?php } else { ?>











        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <form class="form-horizontal" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list/">
                            <div class="form-group">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" name="name" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Search by Name'];?>
..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Search'];?>
</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/add/" class="btn btn-success btn-block"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add New Contact'];?>
</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><?php echo $_smarty_tpl->tpl_vars['_L']->value['Filter by Tags'];?>
</h3>
                        <ul class="tag-list" style="padding: 0">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['t']->value, 'ts');
$_smarty_tpl->tpl_vars['ts']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ts']->value) {
$_smarty_tpl->tpl_vars['ts']->do_else = false;
?>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/list/<?php echo $_smarty_tpl->tpl_vars['ts']->value['text'];?>
/"><i class="fa fa-tag"></i> <?php echo $_smarty_tpl->tpl_vars['ts']->value['text'];?>
</a></li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">

            <?php if (($_smarty_tpl->tpl_vars['_c']->value['contact_set_view_mode']) == 'tbl') {?>

                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover sys_table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-sort-ignore="true"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Image'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Company Name'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
</th>
                                    <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Phone'];?>
</th>
                                    <th class="text-right"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
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

                                    <tr>

                                        <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
</a> </td>

                                        <td class="text-center">


                                            <?php if ($_smarty_tpl->tpl_vars['ds']->value['img'] == 'gravatar') {?>
                                                <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['ds']->value['email']));?>
?s=32" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['ds']->value['lname'];?>
">
                                            <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['img'] == '') {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/theme/ibilling/img/contact_blank_32.png" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['ds']->value['lname'];?>
">
                                            <?php } else { ?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['ds']->value['img'];?>
" class="img-thumbnail img-responsive" style="max-height: 32px;" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
">
                                            <?php }?>

                                        </td>

                                        <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</a> </td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['company'];?>
</td>

                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['ds']->value['email'];?>


                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['ds']->value['phone'];?>

                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-primary btn-xs"><i class="fa fa-search"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['View'];?>
</a>

                                            <a href="delete/crm-user/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-danger btn-xs cdelete" id="uid<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
</a>
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


            <?php } else { ?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                    <div class="col-md-3 sdiv">
                        <!-- CONTACT ITEM -->
                        <div class="panel panel-default">
                            <div class="panel-body profile">
                                <div class="profile-image">
                                    <?php if ($_smarty_tpl->tpl_vars['ds']->value['img'] == 'gravatar') {?>
                                        <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['ds']->value['email']));?>
?s=200" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['ds']->value['lname'];?>
">
                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['img'] == '') {?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
application/storage/system/profile-icon.png" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['ds']->value['lname'];?>
">
                                    <?php } else { ?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['ds']->value['img'];?>
" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
">
                                    <?php }?>
                                </div>
                                <div class="profile-data">

                                    <div class="profile-data-name"><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</div>

                                </div>

                            </div>
                            <div class="panel-body">
                                <div class="contact-info">

                                    <p><small><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
</small><br/><?php if ($_smarty_tpl->tpl_vars['ds']->value['email'] != '') {
echo $_smarty_tpl->tpl_vars['ds']->value['email'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['_L']->value['n_a'];?>
 <?php }?></p>

                                    <p>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-primary btn-xs"><i class="fa fa-search"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['View'];?>
</a>

                                        <a href="delete/crm-user/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/" class="btn btn-danger btn-xs cdelete" id="uid<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <?php }?>

        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo $_smarty_tpl->tpl_vars['paginator']->value['contents'];?>

            </div>
        </div>


    <?php }
}
}
/* {/block "content"} */
}

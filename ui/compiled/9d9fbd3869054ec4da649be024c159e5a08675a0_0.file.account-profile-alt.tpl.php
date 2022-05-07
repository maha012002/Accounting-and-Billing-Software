<?php
/* Smarty version 3.1.39, created on 2021-03-02 16:41:32
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/account-profile-alt.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_603eb10c0989c0_12221242',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d9fbd3869054ec4da649be024c159e5a08675a0' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/account-profile-alt.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603eb10c0989c0_12221242 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1409790754603eb10c08ded0_92596415', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_1409790754603eb10c08ded0_92596415 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1409790754603eb10c08ded0_92596415',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-12 m-t-md">
            <div class="alert alert-danger" id="emsg">
                <span id="emsgbody"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 ib_profile_width">

            <div class="panel panel-default" id="ibox_panel">

                <div class="panel-body">
                    <div class="thumb-info mb-md">
                        <?php if ($_smarty_tpl->tpl_vars['d']->value['img'] == 'gravatar') {?>
                            <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['d']->value['email']));?>
?s=400" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['d']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['d']->value['lname'];?>
">
                        <?php } elseif ($_smarty_tpl->tpl_vars['d']->value['img'] == '') {?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
application/storage/system/profile-icon.png" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['d']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['d']->value['lname'];?>
">
                        <?php } else { ?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['d']->value['img'];?>
" class="img-thumbnail img-responsive" alt="<?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>
">
                        <?php }?>
                        <div class="thumb-info-title">
                            <span class="thumb-info-inner"><?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>
</span>

                        </div>
                    </div>





                    <?php if ($_smarty_tpl->tpl_vars['d']->value['email'] != '') {?>
                        <h5 class="text-muted"><?php echo $_smarty_tpl->tpl_vars['d']->value['email'];?>
</h5>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['d']->value['phone'] != '') {?>
                        <h5 class="text-muted"><?php echo $_smarty_tpl->tpl_vars['d']->value['phone'];?>
</h5>
                    <?php }?>







                </div>

                <div class="panel-body list-group border-bottom m-t-n-lg">
                    <a href="#" id="summary" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Summary'];?>
 </a>
                    <a href="#" id="activity" class="list-group-item"><span class="fa fa-tasks"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Activity'];?>
</a>
                    <a href="#" id="invoices" class="list-group-item"><span class="fa fa-credit-card"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoices'];?>
<span class="label label-info pull-right"><?php echo $_smarty_tpl->tpl_vars['inv_count']->value;?>
</span></a>

                    <a href="#" id="quotes" class="list-group-item"><span class="fa fa-file-text-o"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Quotes'];?>
<span class="label label-info pull-right"><?php echo $_smarty_tpl->tpl_vars['quote_count']->value;?>
</span></a>


                    <a href="#" id="orders" class="list-group-item"><span class="fa fa-server"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Orders'];?>
</a>
                    <a href="#" id="files" class="list-group-item"><span class="fa fa-file-o"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Files'];?>
</a>
                    <a href="#" id="transactions" class="list-group-item"><span class="fa fa-th-list"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Transactions'];?>
</a>
                    <a href="#" id="email" class="list-group-item"><span class="fa fa-envelope-o"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
</a>
                    <?php echo $_smarty_tpl->tpl_vars['extra_tab']->value;?>

                    <a href="#" id="edit" class="list-group-item"><span class="fa fa-pencil"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
</a>
                    <a href="#" id="more" class="list-group-item"><span class="fa fa-bars"></span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['More'];?>
</a>
                </div>

                <div class="panel-body">






                    <h5 class="text-muted"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Contact Notes'];?>
</h5>

                    <textarea class="form-control" id="notes" rows="6"><?php echo $_smarty_tpl->tpl_vars['d']->value['notes'];?>
</textarea>
                    <input type="hidden" id="cid" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
                    <button type="button" id="note_update" class="btn btn-primary btn-block mt-sm"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Save'];?>
</button>




                </div>

            </div>

        </div>

        <div class="col-md-9">

            <!-- START TIMELINE -->
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>
</h5>
                </div>

                <div class="ibox-content" id="ibox_form">
                                                            <div id="application_ajaxrender" style="min-height: 200px;">

                    </div>

                </div>
            </div>
            <!-- END TIMELINE -->

        </div>

    </div>
    <input type="hidden" id="_lan_are_you_sure" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
">
    <input type="hidden" id="_active_tab" value="<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
">


<?php
}
}
/* {/block "content"} */
}

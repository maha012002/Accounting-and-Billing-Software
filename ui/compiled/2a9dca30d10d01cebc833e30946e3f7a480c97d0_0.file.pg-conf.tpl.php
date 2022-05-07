<?php
/* Smarty version 3.1.39, created on 2021-03-02 15:55:26
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/pg-conf.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_603ea63e36ace8_79292438',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a9dca30d10d01cebc833e30946e3f7a480c97d0' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/pg-conf.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603ea63e36ace8_79292438 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1591144374603ea63e3576b1_58347447', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_1591144374603ea63e3576b1_58347447 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1591144374603ea63e3576b1_58347447',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-md-<?php if ($_smarty_tpl->tpl_vars['extra_panel']->value == '') {?>12<?php } else { ?>6<?php }?>">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['d']->value['name'];?>
</h5>

                </div>
                <div class="ibox-content" id="ibox_form">
                    <div class="alert alert-danger" id="emsg">
                        <span id="emsgbody"></span>
                    </div>
                    <form class="form-horizontal" method="post" id="pg-conf" role="form">

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['name'];?>
">
                            </div>
                        </div>

                                                                                                                                                
                        <div class="form-group">
                            <label for="value" class="col-sm-3 control-label">


                                <?php echo $_smarty_tpl->tpl_vars['label']->value['value'];?>




                            </label>
                            <div class="col-sm-9">



                                <?php echo $_smarty_tpl->tpl_vars['input']->value['value'];?>

                                <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['value']) != '') {?>
                                    <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['value'];?>
</span>
                                <?php }?>
                            </div>
                        </div>





                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c1']) != '') {?>
                            <div class="form-group">
                                <label for="c1" class="col-sm-3 control-label"> <?php echo $_smarty_tpl->tpl_vars['label']->value['c1'];?>
 </label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c1'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c1']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c1'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>

                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c2']) != '') {?>

                            <div class="form-group">
                                <label for="c2" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c2'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c2'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c2']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c2'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>

                        <?php }?>


                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c3']) != '') {?>

                            <div class="form-group">
                                <label for="c3" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c3'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c3'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c3']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c3'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>

                        <?php }?>



                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c4']) != '') {?>

                            <div class="form-group">
                                <label for="c4" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c4'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c4'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c4']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c4'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>

                        <?php }?>



                        <?php if (($_smarty_tpl->tpl_vars['label']->value['c5']) != '') {?>
                            <div class="form-group">
                                <label for="c5" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['label']->value['c5'];?>
</label>
                                <div class="col-sm-9">
                                    <?php echo $_smarty_tpl->tpl_vars['input']->value['c5'];?>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['c5']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['c5'];?>
</span>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>


                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Status'];?>
</label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Active') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Active'];?>
</option>
                                    <option value="Inactive" <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Inactive') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Inactive'];?>
</option>

                                </select>



                            </div>
                        </div>


                        <?php if (($_smarty_tpl->tpl_vars['label']->value['mode'])) {?>

                            <div class="form-group">
                                <label for="mode" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Mode'];?>
</label>
                                <div class="col-sm-9">
                                    <select name="mode" id="mode" class="form-control">
                                        <option value="Live" <?php if ($_smarty_tpl->tpl_vars['d']->value['mode'] == 'Live') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Live'];?>
</option>
                                        <option value="Sandbox" <?php if ($_smarty_tpl->tpl_vars['d']->value['mode'] == 'Sandbox') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sandbox'];?>
</option>

                                    </select>

                                    <?php if (($_smarty_tpl->tpl_vars['help_txt']->value['mode']) != '') {?>
                                        <span class="help-block"><?php echo $_smarty_tpl->tpl_vars['help_txt']->value['mode'];?>
</span>
                                    <?php }?>

                                </div>
                            </div>

                        <?php }?>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="hidden" name="pgid" id="pgid" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
">
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
</button>
                                | <?php echo $_smarty_tpl->tpl_vars['_L']->value['Or'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/pg/"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Back To The List'];?>
</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>


        <?php if ($_smarty_tpl->tpl_vars['extra_panel']->value != '') {?>
            <div class="col-md-6">
                <?php echo $_smarty_tpl->tpl_vars['extra_panel']->value;?>

            </div>
        <?php }?>

    </div>




<?php
}
}
/* {/block "content"} */
}

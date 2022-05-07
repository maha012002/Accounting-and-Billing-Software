<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:54:10
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/calendar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3aae20ce033_94530883',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad9b4d49cfaf2a2a61e4db0d6dba19b298c18807' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/calendar.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3aae20ce033_94530883 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_182169467060a3aae20c7b32_48551811', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_182169467060a3aae20c7b32_48551811 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_182169467060a3aae20c7b32_48551811',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default" style="min-height: 400px;" id="calendar_wrap">

                <div class="panel-body">


                    <div id="calendar"></div>


                </div>
            </div>
        </div>



    </div>

    <div id="modal_add_event" class="modal fade-scale" tabindex="-1" data-width="800" style="display: none;">
        <form id="ib_modal_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal_title"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Event'];?>
</h4>
            </div>
            <div class="modal-body">
                <div class="row">





                    <div class="form-group col-md-12">
                        <label for="title"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Event Name'];?>
</label>
                        <input type="text" class="form-control" id="title" name="title" value="" required>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="start"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Start Date'];?>
</label>
                        <input type="text" class="form-control datepicker" id="start" placeholder="Select Date" name="start" value="<?php echo $_smarty_tpl->tpl_vars['mdate']->value;?>
">
                    </div>

                    <div class="form-group col-md-6" id="start_time_div">
                        <label for="start_time"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Start Time'];?>
</label>
                        <div class="input-group clockpicker">

                            <input type="text" id="start_time" name="start_time" class="form-control" value="09:30">
                            <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
                        </div>
                    </div>



                    <div class="form-group col-md-6">
                        <label for="end"><?php echo $_smarty_tpl->tpl_vars['_L']->value['End Date'];?>
</label>
                        <input type="text" class="form-control datepicker" id="end" name="end" value="">
                    </div>

                    <div class="form-group col-md-6" id="end_time_div">
                        <label for="end_time"><?php echo $_smarty_tpl->tpl_vars['_L']->value['End Time'];?>
</label>
                        <div class="input-group clockpicker">

                            <input type="text" class="form-control" id="end_time" name="end_time" value="11:30">
                            <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
                        </div>
                    </div>



                    <div class="form-group col-md-12">

                        <input class="i-checks" type="checkbox" name="all_day_event" value="yes" id="all_day_event">
                        <label for="all_day_event"><?php echo $_smarty_tpl->tpl_vars['_L']->value['All day event'];?>
</label>


                    </div>


                    <div class="form-group col-md-12">
                        <label for="color"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Color'];?>
</label>
                        <input type="text" class="form-control color" id="color" name="color" value="#2196f3">
                    </div>


                    <div class="form-group col-md-12">
                        <label for="description"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</label>
                        <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                    </div>



                    <input type="hidden" id="ib_act" name="ib_act" value="create">
                    <input type="hidden" id="event_id" name="event_id" value="0">






                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="btn_del_event" class="btn btn-danger"><i class="fa fa-trash"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Delete'];?>
</a>
                <button type="button" data-dismiss="modal" class="btn btn-warning"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Close'];?>
</button>
                <button type="submit" id="btn_save_event" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Submit'];?>
</button>
            </div>
        </form>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-primary waves-effect waves-light add_event" href="#">
            <i class="fa fa-plus"></i>
        </a>
    </div>

<?php
}
}
/* {/block "content"} */
}

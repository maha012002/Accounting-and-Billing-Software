<?php
/* Smarty version 3.1.39, created on 2021-03-02 16:41:27
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/dashboard_canvas.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_603eb10751a723_26257048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '275a3e99d7814cb79efdf6828ec592b18c63ace2' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/dashboard_canvas.tpl',
      1 => 1562710339,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603eb10751a723_26257048 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1829101163603eb1074fff78_20729477', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_1829101163603eb1074fff78_20729477 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1829101163603eb1074fff78_20729477',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php echo $_smarty_tpl->tpl_vars['dashboard_section_0']->value;?>




    <div class="row">
        <div class="col-md-12" id="ib_graph"></div>
        <div class="col-md-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="row" id="d_ajax_summary">

                        <div class="col-md-4"><div class="chart-statistic-box">
                                <div class="chart-txt">
                                    <div class="chart-txt-top">
                                        <p><span class="amount number"><?php echo $_smarty_tpl->tpl_vars['net_worth']->value;?>
</span></p>
                                        <hr>
                                        <p class="caption"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Net Worth'];?>
</p>
                                    </div>
                                    <table class="tbl-data">
                                        <tr>
                                            <td class="amount"><?php echo $_smarty_tpl->tpl_vars['ti']->value;?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income Today'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td class="amount"><?php echo $_smarty_tpl->tpl_vars['te']->value;?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense Today'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td class="amount"><?php echo $_smarty_tpl->tpl_vars['mi']->value;?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income This Month'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td class="amount"><?php echo $_smarty_tpl->tpl_vars['me']->value;?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense This Month'];?>
</td>
                                        </tr>
                                    </table>
                                </div>

                            </div></div>


                        <div class="col-md-8">


                            <div class="chart-container">
                                <div class="" style="height:350px" id="inc_vs_exp_t"></div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div id="d_chart" style="height: 350px;"></div>
                </div>
            </div>

        </div>
    </div>


    <div class="row" id="sort_2">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="#" id="set_goal" class="btn btn-primary btn-xs pull-right"><i class="fa fa-bullseye"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Set Goal'];?>
</a>
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Net Worth n Account Balances'];?>
</h5>
                </div>
                <div class="ibox-content" style="min-height: 365px;">
                    <div>
                        <h3 class="text-center amount"><?php echo $_smarty_tpl->tpl_vars['net_worth']->value;?>
</h3>
                        <div>
                            <span class="amount"><?php echo $_smarty_tpl->tpl_vars['net_worth']->value;?>
</span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['of'];?>
 <span class="amount"><?php echo $_smarty_tpl->tpl_vars['_c']->value['networth_goal'];?>
</span>
                            <small class="pull-right"><span class="amount"><?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
</span>%</small>
                        </div>


                        <div class="progress progress-small">
                            <div style="width: <?php echo $_smarty_tpl->tpl_vars['pgb']->value;?>
%;" class="progress-bar progress-bar-<?php echo $_smarty_tpl->tpl_vars['pgc']->value;?>
"></div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" style="margin-top: 26px;">
                        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</th>
                        <th class="text-right"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Balance'];?>
</th>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</td>
                                <td class="text-right"><span class="amount<?php if ($_smarty_tpl->tpl_vars['ds']->value['balance'] < 0) {?> text-red<?php }?>"><?php echo $_smarty_tpl->tpl_vars['ds']->value['balance'];?>
</span></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income vs Expense'];?>
 - <?php echo ib_lan_get_line(date('F'));?>
 <?php echo date('Y');?>
</h5>
                </div>
                <div class="ibox-content">
                    <div id="inc_exp_pie" style="height: 330px;">
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="row" id="sort_4">


        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/list/" class="btn btn-primary btn-xs pull-right"><i class="fa fa-list"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoices'];?>
</a>
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoices'];?>
</h5>
                </div>
                <div class="ibox-content">

                    <div id="invoice_stats" style="display: none;">

                    </div>
                    <h4><?php echo $_smarty_tpl->tpl_vars['_L']->value['Recent Invoices'];?>
</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Date'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Due Date'];?>
</th>
                            <th width="110px;"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Status'];?>
</th>


                        </tr>
                        </thead>
                        <tbody>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                            <tr>
                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['ds']->value['invoicenum'];
if ($_smarty_tpl->tpl_vars['ds']->value['cn'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['ds']->value['cn'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
 <?php }?></a> </td>
                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['userid'];?>
/"><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</a> </td>
                                <td class="amount"><?php echo $_smarty_tpl->tpl_vars['ds']->value['total'];?>
</td>
                                <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['ds']->value['date']));?>
</td>
                                <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['ds']->value['duedate']));?>
</td>
                                <td>


                                    <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] == 'Unpaid') {?>
                                        <span class="label label-danger"><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['status']);?>
</span>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 'Paid') {?>
                                        <span class="label label-success"><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['status']);?>
</span>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 'Partially Paid') {?>
                                        <span class="label label-info"><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['status']);?>
</span>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 'Cancelled') {?>
                                        <span class="label"><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['status']);?>
</span>
                                    <?php } else { ?>
                                        <?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['status']);?>

                                    <?php }?>

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

    <div class="row" id="sort_3">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Latest Income'];?>
</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered">
                        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>
                        <th class="text-right"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['inc']->value, 'incs');
$_smarty_tpl->tpl_vars['incs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['incs']->value) {
$_smarty_tpl->tpl_vars['incs']->do_else = false;
?>
                            <tr>
                                <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['incs']->value['date']));?>
</td>
                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/manage/<?php echo $_smarty_tpl->tpl_vars['incs']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['incs']->value['description'];?>
</a> </td>
                                <td class="text-right amount"><?php echo $_smarty_tpl->tpl_vars['incs']->value['amount'];?>
</td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                    </table>
                </div>
            </div>

        </div>


        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Latest Expense'];?>
</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered">
                        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                        <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>
                        <th class="text-right"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['exp']->value, 'exps');
$_smarty_tpl->tpl_vars['exps']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['exps']->value) {
$_smarty_tpl->tpl_vars['exps']->do_else = false;
?>
                            <tr>
                                <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['exps']->value['date']));?>
</td>
                                <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/manage/<?php echo $_smarty_tpl->tpl_vars['exps']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['exps']->value['description'];?>
</a> </td>
                                <td class="text-right amount"><?php echo $_smarty_tpl->tpl_vars['exps']->value['amount'];?>
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


<?php
}
}
/* {/block "content"} */
}

<?php
/* Smarty version 3.1.39, created on 2021-03-02 15:58:09
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/invoice-view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_603ea6e189b158_56609725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '48d47d84b5d7df6f388bcf9fee42a9d8502f2650' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/invoice-view.tpl',
      1 => 1562710887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603ea6e189b158_56609725 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_177397655603ea6e185edc5_96913347', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['tpl_admin_layout']->value));
}
/* {block "content"} */
class Block_177397655603ea6e185edc5_96913347 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_177397655603ea6e185edc5_96913347',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Unique Invoice URL'];?>
:</label>
                <input type="text" class="form-control" id="invoice_public_url" onClick="this.setSelectionRange(0, this.value.length)" value="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/iview/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
">
            </div>
        </div>
        <div class="col-lg-12"  id="application_ajaxrender">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice'];?>
 - <?php echo $_smarty_tpl->tpl_vars['d']->value['invoicenum'];
if ($_smarty_tpl->tpl_vars['d']->value['cn'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['cn'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
 <?php }?> </h5>
                    <input type="hidden" name="iid" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
" id="iid">


                    <div class="btn-group  pull-right" role="group" aria-label="...">


                        <div class="btn-group" role="group">
                            <button type="button" class="btn  btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>  <?php echo $_smarty_tpl->tpl_vars['_L']->value['Send Email'];?>

                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" id="mail_invoice_created"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Created'];?>
</a></li>
                                <li><a href="#" id="mail_invoice_reminder"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Payment Reminder'];?>
</a></li>
                                <li><a href="#" id="mail_invoice_overdue"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Overdue Notice'];?>
</a></li>
                                <li><a href="#" id="mail_invoice_confirm"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Payment Confirmation'];?>
</a></li>
                                <li><a href="#" id="mail_invoice_refund"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Refund Confirmation'];?>
</a></li>
                            </ul>
                        </div>

                        <div class="btn-group" role="group">
                            <button type="button" class="btn  btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>  <?php echo $_smarty_tpl->tpl_vars['_L']->value['Mark As'];?>

                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] != 'Paid') {?>
                                    <li><a href="#" id="mark_paid"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Paid'];?>
</a></li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] != 'Unpaid') {?>
                                    <li><a href="#" id="mark_unpaid"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Unpaid'];?>
</a></li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] != 'Partially Paid') {?>
                                    <li><a href="#" id="mark_partially_paid"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Partially Paid'];?>
</a></li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] != 'Cancelled') {?>
                                    <li><a href="#" id="mark_cancelled"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Cancelled'];?>
</a></li>
                                <?php }?>

                            </ul>
                        </div>

                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['accounting'] == '1') {?>
                            <button type="button" class="btn  btn-danger btn-sm" id="add_payment"><i class="fa fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Payment'];?>
</button>
                        <?php }?>

                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/iview/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
" target="_blank" class="btn btn-primary  btn-sm"><i class="fa fa-paper-plane-o"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Preview'];?>
</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/edit/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
" class="btn btn-warning  btn-sm"><i class="fa fa-pencil"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
</a>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn  btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-file-pdf-o"></i>
                                <?php echo $_smarty_tpl->tpl_vars['_L']->value['PDF'];?>

                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/ipdf/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
/view/" target="_blank"><?php echo $_smarty_tpl->tpl_vars['_L']->value['View PDF'];?>
</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/ipdf/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
/dl/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Download PDF'];?>
</a></li>
                            </ul>
                        </div>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
iview/print/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/token_<?php echo $_smarty_tpl->tpl_vars['d']->value['vtoken'];?>
" target="_blank" class="btn btn-primary  btn-sm"><i class="fa fa-print"></i> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Print'];?>
</a>


                    </div>

                </div>
                <div class="ibox-content">

                    <div class="invoice">
                        <header class="clearfix">
                            <div class="row">
                                <div class="col-sm-6 mt-md">
                                    <h2 class="h2 mt-none mb-sm text-dark text-bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['INVOICE'];?>
</h2>
                                    <h4 class="h4 m-none text-dark text-bold">#<?php echo $_smarty_tpl->tpl_vars['d']->value['invoicenum'];
if ($_smarty_tpl->tpl_vars['d']->value['cn'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['d']->value['cn'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
 <?php }?></h4>
                                    <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Unpaid') {?>
                                        <h3 class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Unpaid'];?>
</h3>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Paid') {?>
                                        <h3 class="alert alert-success"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Paid'];?>
</h3>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Partially Paid') {?>
                                        <h3 class="alert alert-info"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Partially Paid'];?>
</h3>
                                    <?php } else { ?>
                                        <h3 class="alert alert-info"><?php echo $_smarty_tpl->tpl_vars['d']->value['status'];?>
</h3>
                                    <?php }?>
                                </div>
                                <div class="col-sm-6 text-right mt-md mb-md">
                                    <address class="ib mr-xlg">
                                        <?php echo $_smarty_tpl->tpl_vars['_c']->value['caddress'];?>

                                    </address>
                                    <div class="ib">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
application/storage/system/logo.png" alt="Logo">
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="bill-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bill-to">
                                        <p class="h5 mb-xs text-dark text-semibold"><strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoiced To'];?>
:</strong></p>
                                        <address>
                                            <?php if ($_smarty_tpl->tpl_vars['a']->value['company'] != '') {?>
                                                <?php echo $_smarty_tpl->tpl_vars['a']->value['company'];?>

                                                <br>
                                                <?php echo $_smarty_tpl->tpl_vars['_L']->value['ATTN'];?>
: <?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>

                                                <br>
                                            <?php } else { ?>
                                                <?php echo $_smarty_tpl->tpl_vars['d']->value['account'];?>

                                                <br>
                                            <?php }?>

                                            <?php echo $_smarty_tpl->tpl_vars['a']->value['address'];?>
 <br>
                                            <?php echo $_smarty_tpl->tpl_vars['a']->value['city'];?>
 <br>
                                            <?php echo $_smarty_tpl->tpl_vars['a']->value['state'];?>
 - <?php echo $_smarty_tpl->tpl_vars['a']->value['zip'];?>
 <br>
                                            <?php echo $_smarty_tpl->tpl_vars['a']->value['country'];?>

                                            <br>
                                            <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Phone'];?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['a']->value['phone'];?>

                                            <br>
                                            <strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email'];?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['a']->value['email'];?>

                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cf']->value, 'cfs');
$_smarty_tpl->tpl_vars['cfs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cfs']->value) {
$_smarty_tpl->tpl_vars['cfs']->do_else = false;
?>
                                                <br>
                                                <strong><?php echo $_smarty_tpl->tpl_vars['cfs']->value['fieldname'];?>
: </strong> <?php echo get_custom_field_value($_smarty_tpl->tpl_vars['cfs']->value['id'],$_smarty_tpl->tpl_vars['a']->value['id']);?>

                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                                            <?php echo $_smarty_tpl->tpl_vars['x_html']->value;?>

                                        </address>





                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bill-data text-right">
                                        <p class="mb-none">
                                            <span class="text-dark"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Date'];?>
:</span>
                                            <span class="value"><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['d']->value['date']));?>
</span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Due Date'];?>
:</span>
                                            <span class="value"><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['d']->value['duedate']));?>
</span>
                                        </p>
                                        <h2> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Total'];?>
: <span class="amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['d']->value['total'];?>
</span> </h2>
                                        <?php if (($_smarty_tpl->tpl_vars['d']->value['credit']) != '0.00') {?>
                                            <h2> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Paid'];?>
:  <span class="amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['d']->value['credit'];?>
</span> </h2>
                                                                                        <h2> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount Due'];?>
: <span class="amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['i_due']->value;?>
</span> </h2>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table invoice-items">
                                <thead>
                                <tr class="h4 text-dark">
                                    <th id="cell-id" class="text-semibold">#</th>
                                    <th id="cell-item" class="text-semibold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Item'];?>
</th>

                                    <th id="cell-price" class="text-center text-semibold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Price'];?>
</th>
                                    <th id="cell-qty" class="text-center text-semibold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Quantity'];?>
</th>
                                    <th id="cell-total" class="text-center text-semibold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total'];?>
</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                                    <tr>
                                        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['itemcode'];?>
</td>
                                        <td class="text-semibold text-dark"><?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
</td>

                                        <td class="text-center amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
</td>
                                        <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['item']->value['qty'];?>
</td>
                                        <td class="text-center amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                                    </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                                </tbody>
                            </table>
                        </div>

                        <div class="invoice-summary">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-8">
                                    <table class="table h5 text-dark">
                                        <tbody>
                                        <tr class="b-top-none">
                                            <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Subtotal'];?>
</td>
                                            <td class="text-left amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['d']->value['subtotal'];?>
</td>
                                        </tr>
                                        <?php if (($_smarty_tpl->tpl_vars['d']->value['discount']) != '0.00') {?>
                                            <tr>
                                                <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Discount'];?>
</td>
                                                <td class="text-left amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['d']->value['discount'];?>
</td>
                                            </tr>
                                        <?php }?>
                                        <tr>
                                            <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['TAX'];?>
</td>
                                            <td class="text-left amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['d']->value['tax'];?>
</td>
                                        </tr>
                                        <?php if (($_smarty_tpl->tpl_vars['d']->value['credit']) != '0.00') {?>
                                            <tr>
                                                <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total'];?>
</td>
                                                <td class="text-left amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['d']->value['total'];?>
</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Paid'];?>
</td>
                                                <td class="text-left amount"><?php echo $_smarty_tpl->tpl_vars['d']->value['credit'];?>
</td>
                                            </tr>
                                            <tr class="h4">
                                                <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount Due'];?>
</td>
                                                                                                <td class="text-left amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['i_due']->value;?>
</td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr class="h4">
                                                <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Grand Total'];?>
</td>
                                                <td class="text-left amount" data-a-sign="<?php if ($_smarty_tpl->tpl_vars['d']->value['currency_symbol'] == '') {?> <?php echo $_smarty_tpl->tpl_vars['_c']->value['currency_code'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['d']->value['currency_symbol'];
}?> "><?php echo $_smarty_tpl->tpl_vars['d']->value['total'];?>
</td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (($_smarty_tpl->tpl_vars['trs_c']->value != '')) {?>
                        <h3><?php echo $_smarty_tpl->tpl_vars['_L']->value['Related Transactions'];?>
</h3>
                        <table class="table table-bordered sys_table">
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</th>


                            <th class="text-right"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>

                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>




                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['trs']->value, 'tr');
$_smarty_tpl->tpl_vars['tr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tr']->value) {
$_smarty_tpl->tpl_vars['tr']->do_else = false;
?>
                                <tr class="<?php if ($_smarty_tpl->tpl_vars['tr']->value['cr'] == '0.00') {?>warning <?php } else { ?>info<?php }?>">
                                    <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['tr']->value['date']));?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['tr']->value['account'];?>
</td>


                                    <td class="text-right amount"><?php echo $_smarty_tpl->tpl_vars['tr']->value['amount'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['tr']->value['description'];?>
</td>




                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                        </table>
                    <?php }?>

                    <?php if (($_smarty_tpl->tpl_vars['d']->value['notes']) != '') {?>
                        <div class="well m-t">
                            <?php echo $_smarty_tpl->tpl_vars['d']->value['notes'];?>

                        </div>
                    <?php }?>

                    <?php if (($_smarty_tpl->tpl_vars['emls_c']->value != '')) {?>
                        <hr>
                        <h3><?php echo $_smarty_tpl->tpl_vars['_L']->value['Related Emails'];?>
</h3>
                        <table class="table table-bordered sys_table">
                            <th width="20%"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['_L']->value['Subject'];?>
</th>







                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['emls']->value, 'eml');
$_smarty_tpl->tpl_vars['eml']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['eml']->value) {
$_smarty_tpl->tpl_vars['eml']->do_else = false;
?>
                                <tr>
                                    <td><?php echo date($_smarty_tpl->tpl_vars['_c']->value['df'],strtotime($_smarty_tpl->tpl_vars['eml']->value['date']));?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['eml']->value['subject'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                        </table>
                    <?php }?>



                </div>


            </div>
        </div>
    </div>

    <input type="hidden" id="_lan_msg_confirm" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
">
    <input type="hidden" id="admin_email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
">

<?php
}
}
/* {/block "content"} */
}

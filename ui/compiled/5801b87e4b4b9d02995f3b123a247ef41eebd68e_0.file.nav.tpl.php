<?php
/* Smarty version 3.1.39, created on 2021-05-18 07:53:17
  from '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/sections/nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a3aaad571fb2_48913862',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5801b87e4b4b9d02995f3b123a247ef41eebd68e' => 
    array (
      0 => '/Users/razib/Documents/valet/ibc/ibilling/ui/theme/ibilling/sections/nav.tpl',
      1 => 1621337872,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a3aaad571fb2_48913862 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="nav" id="side-menu">

    <li class="nav-header">
        <div class="dropdown profile-element"> <span>

                <?php if ($_smarty_tpl->tpl_vars['user']->value['img'] == 'gravatar') {?>
                    <img src="http://www.gravatar.com/avatar/<?php echo md5(($_smarty_tpl->tpl_vars['user']->value['username']));?>
?s=64" class="img-circle" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                                <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['img'] == '') {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/imgs/default-user-avatar.png"  class="img-circle" style="max-width: 64px;" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['user']->value['img'];?>
" class="img-circle" style="max-width: 64px;" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                <?php }?>
                             </span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
</strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_smarty_tpl->tpl_vars['_L']->value['My Account'];?>
 <b class="caret"></b></span> </span> </a>
            <ul class="dropdown-menu animated fadeIn m-t-xs">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/users-edit/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit Profile'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/change-password/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Change Password'];?>
</a></li>

                <li class="divider"></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logout/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Logout'];?>
</a></li>
            </ul>
        </div>
    </li>

    <?php echo $_smarty_tpl->tpl_vars['admin_extra_nav']->value[0];?>


    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'reports')) {?>
        <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'dashboard') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;
echo $_smarty_tpl->tpl_vars['_c']->value['redirect_url'];?>
/"><i class="fa fa-tachometer"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Dashboard'];?>
</span></a></li>
    <?php }?>




    <?php echo $_smarty_tpl->tpl_vars['admin_extra_nav']->value[1];?>


    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'customers')) {?>
    <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'contacts') {?>active<?php }?>">
        <a href="#"><i class="icon-users"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Customers'];?>
</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/add/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Add Customer'];?>
</a></li>

            <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['List Customers'];?>
</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/groups/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Groups'];?>
</a></li>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_menu_admin']->value['crm'], 'sm_crm');
$_smarty_tpl->tpl_vars['sm_crm']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sm_crm']->value) {
$_smarty_tpl->tpl_vars['sm_crm']->do_else = false;
?>

                <?php echo $_smarty_tpl->tpl_vars['sm_crm']->value;?>



            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </li>
    <?php }?>


    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'companies','view')) {?>
    <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'companies') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
contacts/companies/"><i class="fa fa-building-o"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Companies'];?>
</span></a></li>
    <?php }?>




    <?php echo $_smarty_tpl->tpl_vars['admin_extra_nav']->value[2];?>

    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'transactions')) {?>
        <?php if ($_smarty_tpl->tpl_vars['_c']->value['accounting'] == '1') {?>
            <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'transactions') {?>active<?php }?>">
                <a href="#"><i class="fa fa-database"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Transactions'];?>
</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/deposit/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Deposit'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/expense/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Expense'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/transfer/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Transfer'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['View Transactions'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
generate/balance-sheet/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Balance Sheet'];?>
</a></li>
                </ul>
            </li>
        <?php }?>
    <?php }?>


    <?php echo $_smarty_tpl->tpl_vars['admin_extra_nav']->value[3];?>



    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'sales')) {?>

        <?php if (($_smarty_tpl->tpl_vars['_c']->value['invoicing'] == '1') || ($_smarty_tpl->tpl_vars['_c']->value['quotes'] == '1')) {?>



            <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'invoices') {?>active<?php }?>">
                <a href="#"><i class="icon-credit-card-1"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sales'];?>
</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <?php if ($_smarty_tpl->tpl_vars['_c']->value['invoicing'] == '1') {?>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoices'];?>
</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/add/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Invoice'];?>
</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/list-recurring/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Recurring Invoices'];?>
</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/add/recurring/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Recurring Invoice'];?>
</a></li>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['_c']->value['quotes'] == '1') {?>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
quotes/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Quotes'];?>
</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
quotes/new/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Create New Quote'];?>
</a></li>
                    <?php }?>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/payments/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Payments'];?>
</a></li>
                </ul>
            </li>

        <?php }?>

    <?php }?>



    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'orders')) {?>

        <?php if (($_smarty_tpl->tpl_vars['_c']->value['orders'] == '1')) {?>



            <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'orders') {?>active<?php }?>">
                <a href="#"><i class="fa fa-server"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Orders'];?>
</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
orders/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['List All Orders'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
orders/add/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Add New Order'];?>
</a></li>

                </ul>
            </li>

        <?php }?>

    <?php }?>



    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'documents')) {?>
        <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'documents') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
documents/"><i class="fa fa-file-o"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Documents'];?>
</span></a></li>
    <?php }?>

    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'calendar')) {?>
        <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'calendar') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
calendar/events/"><i class="fa fa-calendar"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Calendar'];?>
</span></a></li>
    <?php }?>



    <?php echo $_smarty_tpl->tpl_vars['admin_extra_nav']->value[4];?>


    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'bank_n_cash')) {?>
        <?php if ($_smarty_tpl->tpl_vars['_c']->value['accounting'] == '1') {?>
            <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'accounts') {?>active<?php }?>">
                <a href="#"><i class="fa fa-university"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Bank n Cash'];?>
</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
accounts/add/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Account'];?>
</a></li>

                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
accounts/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['List Accounts'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
accounts/balances/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account_Balances'];?>
</a></li>

                </ul>
            </li>
        <?php }?>

    <?php }?>


    <?php echo $_smarty_tpl->tpl_vars['admin_extra_nav']->value[5];?>


    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'products_n_services')) {?>

    <?php if (($_smarty_tpl->tpl_vars['_c']->value['invoicing'] == '1') || ($_smarty_tpl->tpl_vars['_c']->value['quotes'] == '1')) {?>
        <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'ps') {?>active<?php }?>">
            <a href="#"><i class="fa fa-cube"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Products n Services'];?>
</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
ps/p-list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Products'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
ps/p-new/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Product'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
ps/s-list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Services'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
ps/s-new/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['New Service'];?>
</a></li>


            </ul>
        </li>
    <?php }?>

    <?php }?>


    <?php echo $_smarty_tpl->tpl_vars['admin_extra_nav']->value[6];?>


    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'reports')) {?>

            <?php if ($_smarty_tpl->tpl_vars['_c']->value['accounting'] == '1') {?>

            <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'reports') {?>active<?php }?>">
            <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Reports'];?>
 </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">


                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/statement/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account Statement'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/income/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income Reports'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/expense/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense Reports'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/income-vs-expense/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income Vs Expense'];?>
</a></li>

                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/by-date/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Reports by Date'];?>
</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/list-income/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['All Income'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/list-expense/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['All Expense'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['All Transactions'];?>
</a></li>


                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_menu_admin']->value['reports'], 'sm_report');
$_smarty_tpl->tpl_vars['sm_report']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sm_report']->value) {
$_smarty_tpl->tpl_vars['sm_report']->do_else = false;
?>

                    <?php echo $_smarty_tpl->tpl_vars['sm_report']->value;?>



                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


            </ul>
            </li>

        <?php }?>

    <?php }?>

    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'utilities')) {?>

        <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'util') {?>active<?php }?>">
            <a href="#"><i class="icon-article"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Utilities'];?>
 </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
util/activity/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Activity Log'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
util/sent-emails/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Message Log'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
util/dbstatus/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Database Status'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
util/cronlogs/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['CRON Log'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
util/integrationcode/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Integration Code'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
util/sys_status/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['System Status'];?>
</a></li>
            </ul>
        </li>

    <?php }?>


    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'appearance')) {?>

        <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'appearance') {?>active<?php }?>" id="li_appearance">
            <a href="#"><i class="icon-params"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Appearance'];?>
 </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">

                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
appearance/ui/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['User Interface'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
appearance/customize/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Customize'];?>
</a></li>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_menu_admin']->value['appearance'], 'sm_appearance');
$_smarty_tpl->tpl_vars['sm_appearance']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sm_appearance']->value) {
$_smarty_tpl->tpl_vars['sm_appearance']->do_else = false;
?>

                    <?php echo $_smarty_tpl->tpl_vars['sm_appearance']->value;?>



                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
appearance/editor/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Editor'];?>
</a></li>

                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
appearance/themes/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Themes'];?>
</a></li>

            </ul>
        </li>

<?php }?>

    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'plugins')) {?>
        <li <?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'plugins') {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/plugins/"><i class="fa fa-plug"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Plugins'];?>
</span></a></li>
        <?php }?>
    <?php if (has_access($_smarty_tpl->tpl_vars['user']->value->roleid,'settings')) {?>
    <li class="<?php if ($_smarty_tpl->tpl_vars['_application_menu']->value == 'settings') {?>active<?php }?>" id="li_settings">
            <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Settings'];?>
 </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['General Settings'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/users/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Staff'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/roles/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Roles'];?>
</a></li>

                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/localisation/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Localisation'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/currencies/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Currencies'];?>
</a></li>

                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/pg/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Payment Gateways'];?>
</a></li>

                <?php if ($_smarty_tpl->tpl_vars['_c']->value['accounting'] == '1') {?>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/expense-categories/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense Categories'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/income-categories/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income Categories'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/tags/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage Tags'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/pmethods/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Payment Methods'];?>
</a></li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
tax/list/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sales Taxes'];?>
</a></li>
                <?php }?>


                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/emls/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Settings'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/email-templates/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Templates'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/customfields/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Custom Contact Fields'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/automation/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Automation Settings'];?>
</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/api/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['API Access'];?>
</a></li>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_menu_admin']->value['settings'], 'sm_settings');
$_smarty_tpl->tpl_vars['sm_settings']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sm_settings']->value) {
$_smarty_tpl->tpl_vars['sm_settings']->do_else = false;
?>

                    <?php echo $_smarty_tpl->tpl_vars['sm_settings']->value;?>



                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/features/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Choose Features'];?>
</a></li>
            </ul>
            </li>
    <?php }?>




</ul>
<?php }
}

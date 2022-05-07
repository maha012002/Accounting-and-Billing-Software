<ul class="nav" id="side-menu">

    <li class="nav-header">
        <div class="dropdown profile-element"> <span>

                {if $user['img'] eq 'gravatar'}
                    <img src="http://www.gravatar.com/avatar/{($user['username'])|md5}?s=64" class="img-circle" alt="{$user['fullname']}">
                                {elseif $user['img'] eq ''}
                                    <img src="{$app_url}ui/lib/imgs/default-user-avatar.png"  class="img-circle" style="max-width: 64px;" alt="">
                                {else}
                                    <img src="{$user['img']}" class="img-circle" style="max-width: 64px;" alt="{$user['fullname']}">
                {/if}
                             </span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{$user['fullname']}</strong>
                             </span> <span class="text-muted text-xs block">{$_L['My Account']} <b class="caret"></b></span> </span> </a>
            <ul class="dropdown-menu animated fadeIn m-t-xs">
                <li><a href="{$_url}settings/users-edit/{$user['id']}/">{$_L['Edit Profile']}</a></li>
                <li><a href="{$_url}settings/change-password/">{$_L['Change Password']}</a></li>

                <li class="divider"></li>
                <li><a href="{$_url}logout/">{$_L['Logout']}</a></li>
            </ul>
        </div>
    </li>

    {$admin_extra_nav[0]}

    {if has_access($user->roleid,'reports')}
        <li {if $_application_menu eq 'dashboard'}class="active"{/if}><a href="{$_url}{$_c['redirect_url']}/"><i class="fa fa-tachometer"></i> <span class="nav-label">{$_L['Dashboard']}</span></a></li>
    {/if}




    {$admin_extra_nav[1]}

    {if has_access($user->roleid,'customers')}
    <li class="{if $_application_menu eq 'contacts'}active{/if}">
        <a href="#"><i class="icon-users"></i> <span class="nav-label">{$_L['Customers']}</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="{$_url}contacts/add/">{$_L['Add Customer']}</a></li>

            <li><a href="{$_url}contacts/list/">{$_L['List Customers']}</a></li>
            <li><a href="{$_url}contacts/groups/">{$_L['Groups']}</a></li>
            {foreach $sub_menu_admin['crm'] as $sm_crm}

                {$sm_crm}


            {/foreach}
        </ul>
    </li>
    {/if}


    {if has_access($user->roleid,'companies','view')}
    <li {if $_application_menu eq 'companies'}class="active"{/if}><a href="{$_url}contacts/companies/"><i class="fa fa-building-o"></i> <span class="nav-label">{$_L['Companies']}</span></a></li>
    {/if}




    {$admin_extra_nav[2]}
    {if has_access($user->roleid,'transactions')}
        {if $_c['accounting'] eq '1'}
            <li class="{if $_application_menu eq 'transactions'}active{/if}">
                <a href="#"><i class="fa fa-database"></i> <span class="nav-label">{$_L['Transactions']}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{$_url}transactions/deposit/">{$_L['New Deposit']}</a></li>
                    <li><a href="{$_url}transactions/expense/">{$_L['New Expense']}</a></li>
                    <li><a href="{$_url}transactions/transfer/">{$_L['Transfer']}</a></li>
                    <li><a href="{$_url}transactions/list/">{$_L['View Transactions']}</a></li>
                    <li><a href="{$_url}generate/balance-sheet/">{$_L['Balance Sheet']}</a></li>
                </ul>
            </li>
        {/if}
    {/if}


    {$admin_extra_nav[3]}


    {if has_access($user->roleid,'sales')}

        {if ($_c['invoicing'] eq '1') OR ($_c['quotes'] eq '1')}



            <li class="{if $_application_menu eq 'invoices'}active{/if}">
                <a href="#"><i class="icon-credit-card-1"></i> <span class="nav-label">{$_L['Sales']}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    {if $_c['invoicing'] eq '1'}
                        <li><a href="{$_url}invoices/list/">{$_L['Invoices']}</a></li>
                        <li><a href="{$_url}invoices/add/">{$_L['New Invoice']}</a></li>
                        <li><a href="{$_url}invoices/list-recurring/">{$_L['Recurring Invoices']}</a></li>
                        <li><a href="{$_url}invoices/add/recurring/">{$_L['New Recurring Invoice']}</a></li>
                    {/if}

                    {if $_c['quotes'] eq '1'}
                        <li><a href="{$_url}quotes/list/">{$_L['Quotes']}</a></li>
                        <li><a href="{$_url}quotes/new/">{$_L['Create New Quote']}</a></li>
                    {/if}
                    <li><a href="{$_url}invoices/payments/">{$_L['Payments']}</a></li>
                </ul>
            </li>

        {/if}

    {/if}



    {if has_access($user->roleid,'orders')}

        {if ($_c['orders'] eq '1')}



            <li class="{if $_application_menu eq 'orders'}active{/if}">
                <a href="#"><i class="fa fa-server"></i> <span class="nav-label">{$_L['Orders']}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{$_url}orders/list/">{$_L['List All Orders']}</a></li>
                    <li><a href="{$_url}orders/add/">{$_L['Add New Order']}</a></li>

                </ul>
            </li>

        {/if}

    {/if}



    {if has_access($user->roleid,'documents')}
        <li {if $_application_menu eq 'documents'}class="active"{/if}><a href="{$_url}documents/"><i class="fa fa-file-o"></i> <span class="nav-label">{$_L['Documents']}</span></a></li>
    {/if}

    {if has_access($user->roleid,'calendar')}
        <li {if $_application_menu eq 'calendar'}class="active"{/if}><a href="{$_url}calendar/events/"><i class="fa fa-calendar"></i> <span class="nav-label">{$_L['Calendar']}</span></a></li>
    {/if}



    {$admin_extra_nav[4]}

    {if has_access($user->roleid,'bank_n_cash')}
        {if $_c['accounting'] eq '1'}
            <li class="{if $_application_menu eq 'accounts'}active{/if}">
                <a href="#"><i class="fa fa-university"></i> <span class="nav-label">{$_L['Bank n Cash']}</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{$_url}accounts/add/">{$_L['New Account']}</a></li>

                    <li><a href="{$_url}accounts/list/">{$_L['List Accounts']}</a></li>
                    <li><a href="{$_url}accounts/balances/">{$_L['Account_Balances']}</a></li>

                </ul>
            </li>
        {/if}

    {/if}


    {$admin_extra_nav[5]}

    {if has_access($user->roleid,'products_n_services')}

    {if ($_c['invoicing'] eq '1') OR ($_c['quotes'] eq '1')}
        <li class="{if $_application_menu eq 'ps'}active{/if}">
            <a href="#"><i class="fa fa-cube"></i> <span class="nav-label">{$_L['Products n Services']}</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{$_url}ps/p-list/">{$_L['Products']}</a></li>
                <li><a href="{$_url}ps/p-new/">{$_L['New Product']}</a></li>
                <li><a href="{$_url}ps/s-list/">{$_L['Services']}</a></li>
                <li><a href="{$_url}ps/s-new/">{$_L['New Service']}</a></li>


            </ul>
        </li>
    {/if}

    {/if}


    {$admin_extra_nav[6]}

    {if has_access($user->roleid,'reports')}

            {if $_c['accounting'] eq '1'}

            <li class="{if $_application_menu eq 'reports'}active{/if}">
            <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">{$_L['Reports']} </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">


                <li><a href="{$_url}reports/statement/">{$_L['Account Statement']}</a></li>
                <li><a href="{$_url}reports/income/">{$_L['Income Reports']}</a></li>
                <li><a href="{$_url}reports/expense/">{$_L['Expense Reports']}</a></li>
                <li><a href="{$_url}reports/income-vs-expense/">{$_L['Income Vs Expense']}</a></li>

                <li><a href="{$_url}reports/by-date/">{$_L['Reports by Date']}</a></li>
                {*<li><a href="{$_url}reports/cats/">{$_L['Reports by Category']}</a></li>*}
                <li><a href="{$_url}transactions/list-income/">{$_L['All Income']}</a></li>
                <li><a href="{$_url}transactions/list-expense/">{$_L['All Expense']}</a></li>
                <li><a href="{$_url}transactions/list/">{$_L['All Transactions']}</a></li>


                {foreach $sub_menu_admin['reports'] as $sm_report}

                    {$sm_report}


                {/foreach}


            </ul>
            </li>

        {/if}

    {/if}

    {if has_access($user->roleid,'utilities')}

        <li class="{if $_application_menu eq 'util'}active{/if}">
            <a href="#"><i class="icon-article"></i> <span class="nav-label">{$_L['Utilities']} </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{$_url}util/activity/">{$_L['Activity Log']}</a></li>
                <li><a href="{$_url}util/sent-emails/">{$_L['Email Message Log']}</a></li>
                <li><a href="{$_url}util/dbstatus/">{$_L['Database Status']}</a></li>
                <li><a href="{$_url}util/cronlogs/">{$_L['CRON Log']}</a></li>
                <li><a href="{$_url}util/integrationcode/">{$_L['Integration Code']}</a></li>
                <li><a href="{$_url}util/sys_status/">{$_L['System Status']}</a></li>
{*                <li><a href="{$_url}terminal/">{$_L['Terminal']}</a></li>*}
            </ul>
        </li>

    {/if}


    {if has_access($user->roleid,'appearance')}

        <li class="{if $_application_menu eq 'appearance'}active{/if}" id="li_appearance">
            <a href="#"><i class="icon-params"></i> <span class="nav-label">{$_L['Appearance']} </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">

                <li><a href="{$_url}appearance/ui/">{$_L['User Interface']}</a></li>
                <li><a href="{$_url}appearance/customize/">{$_L['Customize']}</a></li>

                {foreach $sub_menu_admin['appearance'] as $sm_appearance}

                    {$sm_appearance}


                {/foreach}

                <li><a href="{$_url}appearance/editor/">{$_L['Editor']}</a></li>

                <li><a href="{$_url}appearance/themes/">{$_L['Themes']}</a></li>

            </ul>
        </li>

{/if}

    {if has_access($user->roleid,'plugins')}
        <li {if $_application_menu eq 'plugins'}class="active"{/if}><a href="{$_url}settings/plugins/"><i class="fa fa-plug"></i> <span class="nav-label">{$_L['Plugins']}</span></a></li>
        {/if}
    {if has_access($user->roleid,'settings')}
    <li class="{if $_application_menu eq 'settings'}active{/if}" id="li_settings">
            <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">{$_L['Settings']} </span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{$_url}settings/app/">{$_L['General Settings']}</a></li>
                <li><a href="{$_url}settings/users/">{$_L['Staff']}</a></li>
                <li><a href="{$_url}settings/roles/">{$_L['Roles']}</a></li>

                <li><a href="{$_url}settings/localisation/">{$_L['Localisation']}</a></li>
                <li><a href="{$_url}settings/currencies/">{$_L['Currencies']}</a></li>

                <li><a href="{$_url}settings/pg/">{$_L['Payment Gateways']}</a></li>

                {if $_c['accounting'] eq '1'}
                    <li><a href="{$_url}settings/expense-categories/">{$_L['Expense Categories']}</a></li>
                    <li><a href="{$_url}settings/income-categories/">{$_L['Income Categories']}</a></li>
                    <li><a href="{$_url}settings/tags/">{$_L['Manage Tags']}</a></li>
                    <li><a href="{$_url}settings/pmethods/">{$_L['Payment Methods']}</a></li>
                    <li><a href="{$_url}tax/list/">{$_L['Sales Taxes']}</a></li>
                {/if}


                <li><a href="{$_url}settings/emls/">{$_L['Email Settings']}</a></li>
                <li><a href="{$_url}settings/email-templates/">{$_L['Email Templates']}</a></li>
                <li><a href="{$_url}settings/customfields/">{$_L['Custom Contact Fields']}</a></li>
                <li><a href="{$_url}settings/automation/">{$_L['Automation Settings']}</a></li>
                <li><a href="{$_url}settings/api/">{$_L['API Access']}</a></li>
                {foreach $sub_menu_admin['settings'] as $sm_settings}

                    {$sm_settings}


                {/foreach}
                <li><a href="{$_url}settings/features/">{$_L['Choose Features']}</a></li>
{*                Uncomment to enable About Page *}
{*                <li><a href="{$_url}settings/about/">{$_L['About']}</a></li>*}
            </ul>
            </li>
    {/if}




</ul>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>
        {$company->company_name}
    </h3>
</div>
<div class="modal-body" style="font-size: 14px;">

    <div class="row">
        <div class="col-md-3 ib_profile_width">

            <div class="panel panel-default" id="ibox_panel">

                <div class="panel-body">
                    <div class="thumb-info mb-md text-center">


                        {if $company->logo_url neq ''}
                            <img style="max-width: 250px;" src="{$company->logo_url}">
                        {else}
                            <img src="{$app_url}/ui/theme/ibilling/img/default_company.png">
                        {/if}


                    </div>






                </div>

                <div class="panel-body list-group border-bottom m-t-n-lg">
                    <a href="#" id="summary" class="list-group-item active li_summary"><span class="fa fa-bar-chart-o"></span> {$_L['Summary']} </a>
                    <a href="#" id="memo" class="list-group-item li_memo"><span class="fa fa-file-text"></span> {$_L['Memo']}</a>
                    <a href="#" id="customers" class="list-group-item li_customers"><span class="icon-users"></span> {$_L['Customers']} <span class="label label-info pull-right">{Companies::countCustomers($company->id)}</span></a>

                    <a href="#" id="invoices" class="list-group-item li_invoices"><span class="fa fa-credit-card"></span> {$_L['Invoices']} <span class="label label-info pull-right">{Companies::countInvoices($company->id)}</span></a>

                    <a href="#" id="quotes" class="list-group-item li_quotes"><span class="fa fa-file-text-o"></span> {$_L['Quotes']} <span class="label label-info pull-right">{Companies::countQuotes($company->id)}</span></a>


                    <a href="#" id="orders" class="list-group-item li_orders"><span class="fa fa-server"></span> {$_L['Orders']} <span class="label label-info pull-right">{Companies::countOrders($company->id)}</span></a>

                    <a href="#" id="transactions" class="list-group-item li_transactions"><span class="fa fa-th-list"></span> {$_L['Transactions']} <span class="label label-info pull-right">{Companies::countTransactions($company->id)}</span></a>


                </div>



            </div>

        </div>

        <div class="col-md-9">

            <!-- START TIMELINE -->
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$company->company_name}</h5>
                </div>

                <div class="ibox-content" id="ibox_form" style="position: static; zoom: 1;">


                    <div id="application_ajaxrender" style="min-height: 200px;">




                    </div>

                </div>
            </div>
            <!-- END TIMELINE -->

        </div>

    </div>

</div>
<div class="modal-footer">

    <input type="hidden" id="base_cid" name="base_cid" value="{$company->id}">
    <button type="button" data-dismiss="modal" class="btn btn-danger">{$_L['Close']}</button>
</div>

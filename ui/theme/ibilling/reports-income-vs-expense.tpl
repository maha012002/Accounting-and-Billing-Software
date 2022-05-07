{extends file="$tpl_admin_layout"}

{block name="content"}

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Reports Income Vs Expense']} </h5>

                </div>
                <div class="ibox-content">


                    <h4>{$_L['Income Vs Expense']}</h4>
                    <hr>
                    <h5>{$_L['Total Income']}: {$_c['currency_code']} {number_format($ai,2,$_c['dec_point'],$_c['thousands_sep'])}</h5>
                    <h5>{$_L['Total Expense']}: {$_c['currency_code']} {number_format($ae,2,$_c['dec_point'],$_c['thousands_sep'])}</h5>
                    <hr>
                    {$_L['Income minus Expense']} = {$_c['currency_code']} {number_format($aime,2,$_c['dec_point'],$_c['thousands_sep'])}
                    <hr>
                    <h5>{$_L['Total Income This Month']}: {$_c['currency_code']} {number_format($mi,2,$_c['dec_point'],$_c['thousands_sep'])}</h5>
                    <h5>{$_L['Total Expense This Month']}: {$_c['currency_code']} {number_format($me,2,$_c['dec_point'],$_c['thousands_sep'])}</h5>
                    <hr>
                    {$_L['Income minus Expense']} = {$_c['currency_code']} {number_format($mime,2,$_c['dec_point'],$_c['thousands_sep'])}
                    <hr>



                    <h4>{$_L['Income Vs Expense This Year']}</h4>
                    <hr>
                    <div id="placeholder" class="flot-placeholder"></div>
                    <hr>


                </div>
            </div>
        </div>


    </div>
    <!-- Row end-->


    <!-- Row end-->


    <!-- Row end-->

{/block}

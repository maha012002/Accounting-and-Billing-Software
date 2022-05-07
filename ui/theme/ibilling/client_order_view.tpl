{include file="sections/header.tpl"}
<div class="panel panel-default">

    <div class="panel-body">

        <div class="row">
            <div class="col-md-4">
                <div class="well">
                    <h4>{$_L['Order Number']} - {$order->ordernum}</h4>
                    <p><strong>{$_L['Customer']}: </strong> {$order->cname}</p>
                    <p><strong>{$_L['Product_Service']}: </strong> {$order->stitle}</p>
                    <p><strong>{$_L['Amount']}: </strong> <span class="amount">{$order->amount}</span> </p>
                    <p><strong>{$_L['Date']}: </strong>{date( $_c['df'], strtotime($order->date_added))}</p>
                    <p><strong>{$_L['Status']}: </strong>

                        {if $order->status eq 'Active'}
                            <span class="label label-success">{ib_lan_get_line($_L[$order->status])}</span>
                        {else}
                            <span class="label label-danger">{ib_lan_get_line($_L[$order->status])}</span>
                        {/if}
                    </p>
                    {if $order->iid neq '0'}
                        <p><strong>{$_L['Invoice']}: </strong> {$order->iid} </p>
                    {/if}



                </div>
            </div>
            <div class="col-md-8">

                <h4>{$_L['Activation Message']}</h4>
                <hr>

                    <h4>{$order->activation_subject}</h4>

                <hr>


                {$order->activation_message}


            </div>
        </div>




    </div>
</div>
{include file="sections/footer.tpl"}
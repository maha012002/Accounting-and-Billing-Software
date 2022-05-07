<?php
if($config['rtl'] == 1) { ?>

<html dir="rtl">
    <?php
} else
{
    ?>
<html>
<?php
}
?>


<head>

    <style>

/*

PDF library using PHP have some limitations and all CSS properties may not support. Before Editing this file, Please create a backup, so that You can restore this.

The location of this file is here- application/lib/invoices/pdf-x2.php

*/

        * { margin: 0; padding: 0; }
        body {
            /*

            Important: Do not Edit Font Name, Unless you are sure. It's required for PDF Rendering Properly

            */


            font: 14px/1.4  dejavusanscondensed;


            /*

            Font Name End

            */
        }

        #page-wrap { width: 800px; margin: 0 auto; }

        table { border-collapse: collapse; }
        table td, table th { border: 1px solid black; padding: 5px; }


        #customer { overflow: hidden; }

        #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }

        #meta { margin-top: 1px; width: 100%; float: right; }
        #meta td { text-align: right;  }
        #meta td.meta-head { text-align: left; background: #eee; }
        #meta td textarea { width: 100%; height: 20px; text-align: right; }

        #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
        #items th { background: #eee; }
        #items textarea { width: 80px; height: 50px; }
        #items tr.item-row td {  vertical-align: top; }
        #items td.description { width: 300px; }
        #items td.item-name { width: 175px; }
        #items td.description textarea, #items td.item-name textarea { width: 100%; }
        #items td.total-line { border-right: 0; text-align: right; }
        #items td.total-value { border-left: 0; padding: 10px; }
        #items td.total-value textarea { height: 20px; background: none; }
        #items td.balance { background: #eee; }
        #items td.blank { border: 0; }

        #terms { text-align: left; margin: 20px 0 0 0; }
        #terms h5 { text-transform: uppercase; font: 13px <?php echo $config['pdf_font']; ?>; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
        #terms textarea { width: 100%; text-align: center;}


<?php

/* ================================================
Following CSS will be loaded for RTL Invoice
*/

if($config['rtl'] == 1){ ?>
#logo{text-align:left;float:left;}
#meta{float:left;}
#meta td{text-align:left;}
#meta td.meta-head{text-align:right;}
#meta td textarea{text-align:left;}
#items{margin:30px 0 0 0;}
#items td.total-line{border-left:0;text-align:left;}
#items td.total-value{border-right:0;}
#terms{text-align:right;margin:20px 0 0 0;}
#terms h5{padding:0 0 8px 0;margin:0 0 8px 0;}
<?php } ?>

    </style>

</head>

<body style="font-family:dejavusanscondensed">

<div id="page-wrap">

    <table width="100%">
        <tr>
            <td style="border: 0;  text-align: left" width="62%">
                <span style="font-size: 18px; color: #2f4f4f"><strong><?php echo $_L['INVOICE']; ?> # <?php
                        if($d['cn'] != ''){
                            $dispid = $d['cn'];
                        }
                        else{
                            $dispid = $d['id'];
                        }
                        echo $d['invoicenum'].$dispid;
                        ?></strong></span>
            </td>
            <td style="border: 0;  text-align: right" width="62%"><div id="logo" style="font-size:18px">
                    <img id="image" src="<?php echo APP_URL; ?>/application/storage/system/logo.png" alt="logo" /> <br> <br>
                    <?php echo $config['caddress']; ?>
                </div></td>
        </tr>



    </table>

<hr>
    <div style="clear:both"></div>

    <div id="customer">

        <table id="meta">
            <tr>
                <td rowspan="5" style="border: 1px solid white; border-right: 1px solid black; text-align: left" width="62%"> <strong><?php echo $_L['Invoiced To']; ?></strong> <br>
                    <?php if($a['company'] != '') {
                        ?>
                        <?php echo $a['company']; ?> <br>
                        <?php echo $_L['ATTN']; ?>: <?php echo $a['account']; ?> <br>
                    <?php
                    }
                    else{
                        ?>
                        <?php echo $d['account']; ?> <br>
                    <?php
                    }
                    ?>
                    <?php echo $a['address']; ?> <br>
                    <?php echo $a['city']; ?> <?php echo $a['state']; ?> <?php echo $a['zip']; ?> <br>
                    <?php echo $a['country']; ?> <br>
                    <?php
                    if(($a['phone']) != ''){
                        echo $_L['Phone'].': '. $a['phone']. ' <br>';
                    }
                    if(($a['email']) != ''){
                        echo 'Email: '. $a['email']. ' <br>';
                    }
                    foreach ($cf as $cfs){
                        echo $cfs['fieldname'].': '. get_custom_field_value($cfs['id'],$a['id']). ' <br>';
                    }
                    ?></td>
                <td class="meta-head"><?php echo $_L['INVOICE']; ?> #</td>
                <td><?php echo $d['invoicenum'].$dispid; ?></td>
            </tr>
            <tr>

                <td class="meta-head"><?php echo $_L['Status']; ?></td>
                <td><?php
                   echo ib_lan_get_line($d['status'])
                    ?></td>
            </tr>
            <tr>

                <td class="meta-head"><?php echo $_L['Invoice Date']; ?></td>
                <td><?php echo date($config['df'], strtotime($d['date'])); ?></td>
            </tr>
            <tr>

                <td class="meta-head"><?php echo $_L['Due Date']; ?></td>
                <td><?php echo date($config['df'], strtotime($d['duedate'])); ?></td>
            </tr>

            <?php
            if($d['credit'] != '0.00'){
                ?>

                <tr>

                    <td class="meta-head"><?php echo $_L['Amount Due']; ?></td>
                    <td><div class="due"><?php echo ib_money_format($i_due,$config,$d['currency_symbol']); ?></div></td>
                </tr>

            <?php
            }
            else{
                ?>
                <tr>

                    <td class="meta-head"><?php echo $_L['Amount Due']; ?></td>

                    <td><div class="due"><?php echo ib_money_format($i_due,$config,$d['currency_symbol']); ?></div></td>
                </tr>
            <?php
            }
            ?>

        </table>

    </div>

    <table id="items">

        <tr>
            <th width="65%"><?php echo $_L['Item']; ?></th>
            <th align="right"><?php echo $_L['Price']; ?></th>
            <th align="right"><?php echo $_L['Qty']; ?></th>
            <th align="right"><?php echo $_L['Total']; ?></th>

        </tr>



        <?php

        foreach ($items as $item){
            echo '  <tr class="item-row">


            <td class="description">'.$item['description'].'</td>
            <td align="right">'.ib_money_format($item['amount'],$config,$d['currency_symbol']).'</td>
            <td align="right">'.$item['qty'].'</td>
            <td align="right"><span class="price">'.ib_money_format($item['total'],$config,$d['currency_symbol']).'</span></td>
        </tr>';
        }

        ?>


        <tr>
            <td class="blank"> </td>
            <td colspan="2" class="total-line"><?php echo $_L['Sub Total']; ?></td>
            <td class="total-value"><div id="subtotal"><?php echo ib_money_format($d['subtotal'],$config,$d['currency_symbol']); ?></div></td>
        </tr>
        <?php
        if(($d['discount']) != '0.00'){

            ?>
            <tr>
                <td class="blank"> </td>
                <td colspan="2" class="total-line"><?php echo $_L['Discount']; ?>

                    <?php
                    if($d['discount_type'] == 'p'){
                        echo '('.$d['discount_value'].')%';
                    }
                    ?>
                </td>
                <td class="total-value"><div id="subtotal"><?php echo ib_money_format($d['discount'],$config,$d['currency_symbol']); ?></div></td>
            </tr>
        <?php
        }
        ?>
        <?php
        if (($d['tax']) != '0.00'){
            ?>
            <tr>

                <td class="blank"> </td>
                <td colspan="2" class="total-line"><?php echo $_L['TAX']; ?></td>
                <td class="total-value"><div id="total"><?php echo ib_money_format($d['tax'],$config,$d['currency_symbol']); ?></div></td>
            </tr>
        <?php
        }
        ?>

        <?php
        if($d['credit'] != '0.00'){
            ?>
            <tr>
                <td class="blank"> </td>
                <td colspan="2" class="total-line"><?php echo $_L['Invoice Total']; ?></td>
                <td class="total-value"><div class="due"><?php echo ib_money_format($d['total'],$config,$d['currency_symbol']); ?></div></td>
            </tr>
            <tr>
                <td class="blank"> </td>
                <td colspan="2" class="total-line"><?php echo $_L['Total Paid']; ?></td>
                <td class="total-value"><div class="due"><?php echo ib_money_format($d['credit'],$config,$d['currency_symbol']); ?></div></td>
            </tr>
            <tr>
                <td class="blank"> </td>
                <td colspan="2" class="total-line balance"><?php echo $_L['Amount Due']; ?></td>
                <td class="total-value balance"><div class="due"><?php echo ib_money_format($i_due,$config,$d['currency_symbol']); ?></div></td>
            </tr>
        <?php
        }
        else{
            ?>
            <tr>
                <td class="blank"> </td>
                <td colspan="2" class="total-line balance"><?php echo $_L['Grand Total']; ?></td>
                <td class="total-value balance"><div class="due"><?php echo ib_money_format($d['total'],$config,$d['currency_symbol']); ?></div></td>
            </tr>
        <?php
        }
        ?>

    </table>

    <!--    related transactions -->

    <?php
    if ($trs_c != ''){
        ?>
        <br>
        <h4><?php echo $_L['Related Transactions']; ?>: </h4>
        <table id="related_transactions" style="width: 100%">

            <tr>
                <th align="left" width="20%"><?php echo $_L['Date']; ?></th>
                <th align="left"><?php echo $_L['Account']; ?></th>
                <th width="50%" align="left"><?php echo $_L['Description']; ?></th>
                <th align="right"><?php echo $_L['Amount']; ?></th>

            </tr>



            <?php

            foreach ($trs as $tr){
                echo '  <tr class="item-row">


            <td align="left">'.date( $config['df'], strtotime($tr['date'])).'</td>
            <td align="left">'.$tr['account'].'</td>
            <td align="left">'.$tr['description'].'</td>
            <td align="right"><span class="price">'.ib_money_format($tr['amount'],$config,$d['currency_symbol']).'</span></td>
        </tr>';
            }

            ?>


        </table>
    <?php
    }
    ?>

    <!--    end related transactions -->

    <?php
    if($d['notes'] != ''){

        ?>
        <div id="terms">
            <h5><?php echo $_L['Terms']; ?></h5>
            <?php echo $d['notes']; ?>
        </div>
    <?php
    }
    ?>



</div>

</body>

</html>
$(document).ready(function () {
    var _url = $("#_url").val();
    $.post(_url + 'contacts/render-address/', {
        cid: $('#cid').val()

    })
        .done(function (data) {
            var adrs = $("#address");


            adrs.html(data);

        });
    function updateTax() {
        var tbal = 0;
        $('.taxed').each(function() {
            var valueSelected = this.value;
            if(valueSelected == 'Yes'){
                var ltbal = parseFloat($('#stax').val());
                var lt = $(this).closest('tr').find(".lvtotal").val();
                var ltf = parseFloat(lt);

                var tx = (ltf*ltbal)/100;

                tbal += tx;
            }

        });
        ftbal = parseFloat(tbal).toFixed(2);
        $('#taxtotal').html(ftbal);
    }

    function updateTotal() {
        var total = 0;

        var sub_total = parseFloat($("#sub_total").html());
        var tax_total = parseFloat($("#taxtotal").html());

        if( !isNaN( sub_total ) ) {
            total = sub_total + tax_total;
        }
        ftbal = parseFloat(total).toFixed(2);
        $('#total').html(ftbal);
    }

    $('#tid').select2()
        .on("change", function(e) {
            // mostly used event, fired to the original element when the value changes
            // log("change val=" + e.val);
            //  alert(e.val);
            var tid = e.val;
            if(tid != ''){
                var _url = $("#_url").val();
                $.post(_url + 'tax/rate', {
                    tid: tid

                })
                    .done(function (data) {
                        //   $('.taxed').val(data);
                        $('#stax').val(data);
                        calculateTotal();
                        updateTax();
                    });
            }
            else{
                $('#stax').val('0.00');
                calculateTotal();
                updateTax();
                updateTotal();

            }

        });

    $('#invoice_items').on('change', 'select', function(){
        //   $('#taxtotal').html('dd');
        var taxrate = $('#stax').val();
        // $(this).val(taxrate);
        updateTax();
        updateTotal();
    });

    var item_remove = $('#item-remove');
    item_remove.hide();
    function calculateTotal() {
        var sum = 0,
            tbl = $('#invoice_items');
        tbl.find('.lvtotal').each(function( index, elem ) {
            var val = parseFloat($(elem).val());
            if( !isNaN( val ) ) {
                sum += val;
            }
        });
        $('.qty').keyup(function(){
            var u_qty = $(this).val();
            var u_price = $(this).closest('tr').find(".item_price").val();
            if( !isNaN( u_qty ) ) {
                var n_ltotal = u_qty*u_price;
                $(this).closest('tr').find(".lvtotal").val(n_ltotal);
                calculateTotal();
            }

        });
        $('.item_price').keyup(function(){
            var u_qty = $(this).closest('tr').find(".qty").val();
            var u_price = $(this).val();
            if( !isNaN( u_price ) ) {
                var n_ltotal = u_qty*u_price;
                $(this).closest('tr').find(".lvtotal").val(n_ltotal);
                calculateTotal();
            }

        });
        // tbl.find('input.total').html(sum.toFixed(2));
        $("#sub_total").html(sum.toFixed(2));
        //calculate tax
        updateTax();
        updateTotal();
    }

    calculateTotal();
    updateTax();
    updateTotal();

    $('#cid').select2()
        .on("change", function(e) {
            // mostly used event, fired to the original element when the value changes
            // log("change val=" + e.val);
            //  alert(e.val);

            var _url = $("#_url").val();
            $.post(_url + 'contacts/render-address/', {
                cid: $('#cid').val()

            })
                .done(function (data) {
                    var adrs = $("#address");


                    adrs.html(data);

                });
        });






    item_remove.on('click', function(){
        $("#invoice_items tr.info").fadeOut(300, function(){
            $(this).remove();
            calculateTotal();
        });

    });

    var $modal = $('#ajax-modal');



    $('#item-add').on('click', function(){

        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');

        setTimeout(function(){
            $modal.load( _url + 'ps/modal-list/', '', function(){
                $modal.modal();

            });
        }, 1000);
    });

    $('#invoice_items').on('click', '.item_name', function(){
        $("tr").removeClass("info");
        $(this).closest('tr').addClass("info");
        item_remove.show();
    });

    $modal.on('click', '.update', function(){
        var tableControl= document.getElementById('items_table');
        $modal.modal('loading');
        setTimeout(function(){
            $modal.modal('loading');
            //$modal
            //    .modal('loading')
            //    .find('.modal-body')
            //    .prepend('<div class="alert alert-info fade in">' +
            //    'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
            //    '</div>');

            // var obj = new Array();

            $('input:checkbox:checked', tableControl).each(function() {

                var item_code = $(this).closest('tr').find('td:eq(1)').text();
                var item_name = $(this).closest('tr').find('td:eq(2)').text();

                var item_price = $(this).closest('tr').find('td:eq(3)').text();

                //  obj.push(innertext);
                $("#invoice_items").find('tbody')
                    .append(
                    '<tr> <td>' + item_code + '</td> <td><input type="text" class="form-control item_name" name="desc[]" value="' + item_name + '"></td> <td><input type="text" class="form-control qty" value="1" name="qty[]"></td> <td><input type="text" class="form-control item_price" name="amount[]" value="' + item_price + '"></td> <td class="ltotal"><input type="text" class="form-control lvtotal" readonly value="' + item_price + '"></td> </tr>'
                );
            });

            //  console.debug(obj); // Write it to the console
            calculateTotal();


            $modal.modal('hide');

        }, 1000);

    });








    $(".progress").hide();
    $("#emsg").hide();
    $("#submit").click(function (e) {
        e.preventDefault();
        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i> Working ...');
        $(this).addClass("btn-danger");
        var _url = $("#_url").val();
        $.post(_url + 'invoices/edit-post/', $('#invform').serialize(), function(data){

            setTimeout(function () {
                var sbutton = $("#submit");
                var _url = $("#_url").val();
                if ($.isNumeric(data)) {

                    window.location = _url + 'invoices/view/' + data + '/';
                }
                else {
                    sbutton.html('<i class="fa fa-check"></i> Submit');
                    sbutton.removeClass("btn-danger");
                    var body = $("html, body");
                    body.animate({scrollTop:0}, '1000', 'swing');
                    $("#emsgbody").html(data);
                    $("#emsg").show("slow");
                }
            }, 2000);
        });
    });
});
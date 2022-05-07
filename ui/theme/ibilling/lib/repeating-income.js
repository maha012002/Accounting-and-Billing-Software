$(document).ready(function () {
    $('.amount').autoNumeric('init');
    $("#a_hide").hide();
    $("#emsg").hide();
    $("#a_toggle").click(function(e){
        e.preventDefault();
        $("#a_hide").toggle();
    });
    /*
     * File upload
     * */

    //Dropzone.options.myAwesomeDropzone = {
    //
    //    autoProcessQueue: false,
    //    uploadMultiple: true,
    //    parallelUploads: 100,
    //    maxFiles: 100,
    //
    //    // Dropzone settings
    //    init: function() {
    //        var myDropzone = this;
    //
    //        this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
    //            e.preventDefault();
    //            e.stopPropagation();
    //            myDropzone.processQueue();
    //        });
    //        this.on("sendingmultiple", function() {
    //        });
    //        this.on("successmultiple", function(files, response) {
    //        });
    //        this.on("errormultiple", function(files, response) {
    //        });
    //    }
    //
    //}

    var _url = $("#_url").val();
    $('#tags').select2({
        tags: true,
        tokenSeparators: [','],
        createSearchChoice: function (term) {
            return {
                id: $.trim(term),
                text: $.trim(term) + ' (new tag)'
            };
        },
        ajax: {
            url: _url + 'tags/income/',
            dataType: 'json',
            data: function(term, page) {
                return {
                    q: term
                };
            },
            results: function(data, page) {
                return {
                    results: data
                };
            }
        },

        // Take default tags from the input value
        initSelection: function (element, callback) {
            var data = [];

            function splitVal(string, separator) {
                var val, i, l;
                if (string === null || string.length < 1) return [];
                val = string.split(separator);
                for (i = 0, l = val.length; i < l; i = i + 1) val[i] = $.trim(val[i]);
                return val;
            }

            $(splitVal(element.val(), ",")).each(function () {
                data.push({
                    id: this,
                    text: this
                });
            });

            callback(data);
        },

        // Some nice improvements:

        // max tags is 3
        maximumSelectionSize: 15,

        // override message for max tags
        formatSelectionTooBig: function (limit) {
            return "Max tags is " + limit;
        }
    });
    $("#submit").click(function (e) {
        e.preventDefault();

        $(this).html('<i class="fa fa-circle-o-notch fa-spin"></i> Working ...');
        $(this).addClass("btn-danger");
        var _url = $("#_url").val();
        $.post(_url + 'repeating/income-post/', {


            account: $('#account').val(),
            date: $('#date').val(),
            frequency: $('#frequency').val(),
            np: $('#np').val(),

            amount: $('#amount').val(),
            cats: $('#cats').val(),
            description: $('#description').val(),
            tags: $('#tags').val(),
            payer: $('#payer').val(),
            pmethod: $('#pmethod').val(),
            ref: $('#ref').val()

        })
            .done(function (data) {

                setTimeout(function () {
                    var sbutton = $("#submit");
                    var _url = $("#_url").val();
                    if ($.isNumeric(data)) {

                        location.reload();
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
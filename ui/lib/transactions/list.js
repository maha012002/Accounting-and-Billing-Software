function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var _url = $("#_url").val();

var ng = getParameterByName('ng');

var search_for = ng.split('/');

$(function() {











    var $ts_pager_filter = $("#ts_pager_filter");

    function load_data(){
        altair_helpers.content_preloader_show();
        $.ajax({
            url :  _url + 'contacts/ajax_list_render/',
            success : function(data) {
                $('.uk-table tbody').html(data);
                $('.ts_checkbox').iCheck('check');
                if(Modernizr.touch) {
                    // make table cell focusable
                    var $focus_highlight = $('.focus-highlight');
                    if ( $focus_highlight.length ) {
                        $focus_highlight
                            .find('td, th')
                            .attr('tabindex', '1')
                            .on('touchstart', function() {
                                $(this).focus();
                            });
                    }
                    // disable fastclick on table headers (touch devices)
                    $('.tablesorter').find('th').addClass('needsclick');
                }




                // pager + filters
                altair_tablesorter.pager_filter_example();
                // align widget example
                altair_tablesorter.align_widget_example();

                altair_helpers.content_preloader_hide();


                if(typeof search_for[2] !== 'undefined') {
                    $ts_pager_filter.find('input.tablesorter-filter').eq(3).val(search_for[2]);

                }





            }
        });


    }

    load_data();


    var btn_form_action = $("#btn_form_action");

    var form_qa = $("#form_qa");

    var progress_icon = '<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div>';


    var iform = $('#iform');

    btn_form_action.on('click', function(e) {
        e.preventDefault();
        form_qa.block({ message: progress_icon });
        $.post( _url + "contacts/add-post/", iform.serialize())
            .done(function (data) {
                if ($.isNumeric(data)) {

                    location.reload();

                }
                else {



                    // OR

                    form_qa.unblock();

                    UIkit.notify({
                        message : data,
                        status  : 'danger',
                        timeout : 3000,
                        pos     : 'top-center'
                    });



                }
            });

    });



    // AutoComplete (custom template)
    var countries = ["Albania", "Andorra", "Armenia", "Austria", "Azerbaijan", "Belarus", "Belgium", "Bosnia & Herzegovina", "Bulgaria", "Croatia", "Cyprus", "Czech Republic", "Denmark", "Estonia", "Finland", "France", "Georgia", "Germany", "Greece", "Hungary", "Iceland", "Ireland", "Italy", "Kosovo", "Latvia", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Malta", "Moldova", "Monaco", "Montenegro", "Netherlands", "Norway", "Poland", "Portugal", "Romania", "Russia", "San Marino", "Serbia", "Slovakia", "Slovenia", "Spain", "Sweden", "Switzerland", "Turkey", "Ukraine", "United Kingdom", "Vatican City"];

    var countriesDS = new kendo.data.DataSource({
        data: countries
    });

    var getFilters = function (filter) {
        var filters = [];
        filters.push(filter);
        values = autoComplete.value().split(", ");
        values.pop();
        $.each(values, function (index, item) {
            filters.push({field: "", ignoreCase: true, operator: "neq", value: item});
        });
        return filters;
    };

    var autoComplete = $("#company").kendoAutoComplete({
        filter: "startswith",
        placeholder: "Search Company...",
        dataSource: {
            transport: {
                read: function (options, operation) {
                    countriesDS.read();
                    countriesDS.filter({logic: "and", filters: getFilters(options.data.filter.filters[0])});
                    options.success(countriesDS.view());
                }
            },
            serverFiltering: true
        }
    }).data("kendoAutoComplete");



});




altair_tablesorter = {
    pager_filter_example: function() {

        var $ts_pager_filter = $("#ts_pager_filter");

        // define pager options
        var pagerOptions = {
            // target the pager markup - see the HTML block below
            container: $(".ts_pager"),
            // output string - default is '{page}/{totalPages}'; possible variables: {page}, {totalPages}, {startRow}, {endRow} and {totalRows}
            output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',
            // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
            // table row set to a height to compensate; default is false
            fixedHeight: true,
            // remove rows from the table to speed up the sort of large tables.
            // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
            removeRows: false,
            // go to page selector - select dropdown that sets the current page
            cssGoto: '.ts_gotoPage'
        };

        // Initialize tablesorter
        var ts_users = $ts_pager_filter
            .tablesorter({
                theme: 'altair',
                widthFixed: true,
                widgets: ['zebra', 'filter'],
                headers: {
                    0: {
                        sorter: false,
                        parser: false
                    }
                }
            })
            // initialize the pager plugin
            .tablesorterPager(pagerOptions)
            .on('tablesorter-ready', function(e, filter){
                // update selectize value



                if(typeof search_for[2] !== 'undefined') {
                    $ts_pager_filter.trigger('search', false);

                }


            })
            .on('pagerComplete', function(e, filter){
                // update selectize value
                if(typeof selectizeObj !== 'undefined' && selectizeObj.data('selectize')) {
                    selectizePage = selectizeObj[0].selectize;
                    selectizePage.setValue($('select.ts_gotoPage option:selected').index() + 1, false);
                }




            });


        // replace 'goto Page' select
        function createPageSelectize() {
            selectizeObj = $('select.ts_gotoPage')
                .val($("select.ts_gotoPage option:selected").val())
                .after('<div class="selectize_fix"></div>')
                .selectize({
                    hideSelected: true,
                    onDropdownOpen: function($dropdown) {
                        $dropdown
                            .hide()
                            .velocity('slideDown', {
                                duration: 200,
                                easing: easing_swiftOut
                            })
                    },
                    onDropdownClose: function($dropdown) {
                        $dropdown
                            .show()
                            .velocity('slideUp', {
                                duration: 200,
                                easing: easing_swiftOut
                            });

                        // hide tooltip
                        $('.uk-tooltip').hide();
                    }
                });
        }
        createPageSelectize();

        // replace 'pagesize' select
        $('.pagesize.ts_selectize')
            .after('<div class="selectize_fix"></div>')
            .selectize({
                hideSelected: true,
                onDropdownOpen: function($dropdown) {
                    $dropdown
                        .hide()
                        .velocity('slideDown', {
                            duration: 200,
                            easing: easing_swiftOut
                        })
                },
                onDropdownClose: function($dropdown) {
                    $dropdown
                        .show()
                        .velocity('slideUp', {
                            duration: 200,
                            easing: easing_swiftOut
                        });

                    // hide tooltip
                    $('.uk-tooltip').hide();

                    if(typeof selectizeObj !== 'undefined' && selectizeObj.data('selectize')) {
                        selectizePage = selectizeObj[0].selectize;
                        selectizePage.destroy();
                        $('.ts_gotoPage').next('.selectize_fix').remove();
                        setTimeout(function() {
                            createPageSelectize()
                        })
                    }

                }
            });

        // select/unselect table rows
        $('.ts_checkbox_all')
            .iCheck({
                checkboxClass: 'icheckbox_md',
                radioClass: 'iradio_md',
                increaseArea: '20%'
            })
            .on('ifChecked',function() {
                $ts_pager_filter
                    .find('.ts_checkbox')
                    // check all checkboxes in table
                    .prop('checked',true)
                    .iCheck('update')
                    // add highlight to row
                    .closest('tr')
                    .addClass('row_highlighted');
            })
            .on('ifUnchecked',function() {
                $ts_pager_filter
                    .find('.ts_checkbox')
                    // uncheck all checkboxes in table
                    .prop('checked',false)
                    .iCheck('update')
                    // remove highlight from row
                    .closest('tr')
                    .removeClass('row_highlighted');
            });

        // select/unselect table row
        $ts_pager_filter.find('.ts_checkbox')
            .on('ifUnchecked',function() {
                $(this).closest('tr').removeClass('row_highlighted');
                $('.ts_checkbox_all').prop('checked',false).iCheck('update');
            }).on('ifChecked',function() {
                $(this).closest('tr').addClass('row_highlighted');
            });

        // remove single row
        $ts_pager_filter.on('click','.ts_remove_row',function(e) {
            e.preventDefault();

            var $this = $(this);
            UIkit.modal.confirm('Are you sure you want to delete this user?', function(){


                $.get(  _url + "delete/crm-user/" + $this[0].id, function( data ) {
                    $this.closest('tr').remove();
                    ts_users.trigger('update');
                });



            }, {
                labels: {
                    'Ok': 'Delete'
                }
            });
        });

    },
    align_widget_example: function() {
        $('#ts_align')
            .tablesorter({
                theme: 'altair',
                widgets: ['zebra', 'alignChar'],
                widgetOptions : {
                    alignChar_wrap         : '<i/>',
                    alignChar_charAttrib   : 'data-align-char',
                    alignChar_indexAttrib  : 'data-align-index',
                    alignChar_adjustAttrib : 'data-align-adjust' // percentage width adjustments
                }
            });
    }
};


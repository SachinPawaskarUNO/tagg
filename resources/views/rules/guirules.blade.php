
@extends('layouts.app')
@section('header')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    <script type="text/javascript" src="{{ asset('querybuilder/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('querybuilder/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@section('content')
<div class="container"style="padding-left:800px"> <div class="dropdown">
<button class="btn btn-basic btn-lg dropdown-toggle" type="button" data-toggle="dropdown">Select Rule
<span class="caret"></span></button>
<ul class="dropdown-menu">
  <li><a href="">PreApproval</a></li>
  <li><a href="">AutoReject</a></li>
</ul>
</div></div>
<br>
    <!--<section class="bs-docs-section clearfix"> -->

    <div class="col-md-12 col-lg-10 col-lg-offset-1">
        <div id="builder-plugins"></div>
        <div class="btn-group">
            <button class="btn btn-error parse-json" data-target="plugins">Preview Rules</button>
            <button class="btn backbtn reset" data-target="plugins">Clear Rules</button>
            <button class="btn btn-success set-json" data-target="plugins">Reset Rules</button>
            <button class="btn btn-basic parse-json" data-target="plugins">Save (Show) Rules</button>
        </div>
        <br />
        <!-- <div id="querybuilder"></div> -->
    </div>
    <!-- </section> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/awesome-bootstrap-checkbox/1.0.0/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="{{ asset('querybuilder/jquery-querybuilder/dist/css/query-builder.default.css') }}" rel="stylesheet">


    <script src="{{ asset('querybuilder/jquery-extendext/jQuery.extendext.js') }}"></script>
    <script src="{{ asset('querybuilder/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('querybuilder/dot/doT.js') }}"></script>
    <!-- <script src="{{ asset('querybuilder/jquery-querybuilder/dist/js/query-builder.js') }}"></script>
    <script src="{{ asset('querybuilder/jquery-querybuilder/dist/i18n/query-builder.en.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/bootstrap-slider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sql-parser@0.5.0/browser/sql-parser.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.9/interact.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('querybuilder/jquery-querybuilder/dist/js/query-builder.js') }}"></script>
    <script src="{{ asset('querybuilder/jquery-querybuilder/dist/i18n/query-builder.en.js') }}"></script>
    <!-- -->
    <script src="{{ asset('querybuilder/rulebuilder.js') }}"></script>
    <style>
        .code-popup {
            max-height: 500px;
        }
        .modal-backdrop {
            z-index: -1;
        }
    </style>
    <!-- <script>alert('Contact form scripts');</script> -->

    <script>
        var rules_plugins = {
            condition: 'AND',
            rules: [
                {
                    id: 'amount',
                    operator: 'less',
                    value: 500.00
                }, {
                    condition: 'OR',
                    rules: [{
                        id: 'category',
                        operator: 'equal',
                        value: 2
                    }, {
                        id: 'category',
                        operator: 'equal',
                        value: 6
                    }, {
                        id: 'category',
                        operator: 'not_equal',
                        value: 1
                    }]
                }, {
                    condition: 'AND',
                    rules: [{
                        id: 'name',
                        operator: 'equal',
                        value: 'Naggy Group 1'
                    }, {
                        id: 'name',
                        operator: 'equal',
                        value: 'Naggy Group 2'
                    }, {
                        id: 'amount',
                        operator: 'less_or_equal',
                        value: 50.00
                    }]
                }]
        };

        $('#builder-plugins').queryBuilder({
            plugins: [
                'sortable',
                'filter-description',
                'unique-filter',
                'bt-tooltip-errors',
                'bt-selectpicker',
                'bt-checkbox',
                'invert',
                'not-group'
            ],

            filters: [{
                id: 'name',
                label: 'Name',
                type: 'string'
            }, {
                id: 'category',
                label: 'Category',
                type: 'integer',
                input: 'select',
                values: {
                    1: 'Athletics',
                    2: 'Cancer Research',
                    3: 'Health Care',
                    4: 'Housing',
                    5: 'Youth Organization',
                    6: 'Veteran Affairs'
                },
                operators: ['equal', 'not_equal', 'in', 'not_in', 'is_null', 'is_not_null']
            }, {
                id: 'in_stock',
                label: 'In stock',
                type: 'integer',
                input: 'radio',
                values: {
                    1: 'Yes',
                    0: 'No'
                },
                operators: ['equal']
            }, {
                id: 'amount',
                label: 'Amount',
                type: 'double',
                validation: {
                    min: 0,
                    step: 0.01
                }
            }, {
                id: 'id',
                label: 'Identifier',
                type: 'string',
                placeholder: '____-____-____',
                operators: ['equal', 'not_equal'],
                validation: {
                    format: /^.{4}-.{4}-.{4}$/
                }
            }],

            rules: rules_plugins
        });
        $('#btn-reset').on('click', function() {
            $('#builder-plugins').queryBuilder('reset');
        });

        $('#btn-set').on('click', function() {
            $('#builder-plugins').queryBuilder('setRules', rules_plugins);
        });

        $('#btn-get').on('click', function() {
            var result = $('#builder-plugins').queryBuilder('getRules');

            if (!$.isEmptyObject(result)) {
                alert(JSON.stringify(result, null, 2));
            }
        });
        ////////////////////////////////////////////////////////////////////////////
        // the default rules, what will be used on page loads...
        /*var datatablesRequest = {};
        var _rules = defaultRules = {"condition":"AND","rules":[
            {"id":"active","field":"active","type":"integer","input":"radio","operator":"equal","value":"1"}
        ]};

        // a button/link that is used to update the rules.
        function updateFilters() {
            _rules = $('#querybuilder').queryBuilder('getRules');
            reloadDatatables();
        }

        function filterChange() {
            var _json = JSON.stringify( _rules );
            datatablesRequest = { rules: _json };
        }

        filterChange();

        function reloadDatatables() {
            // Datatables first...
            filterChange();

            $('.dataTable').each(function() {
                dt = $(this).dataTable();
                dt.fnDraw();
            })
        }

        jQuery(document).ready(function(){
            // dynamic table
            oTable = jQuery('.datatable').dataTable({
                "fnServerParams": function(aoData) {
                    // add the extra parameters from the jQuery QueryBuilder to the Datatable endpoint...
                    $.each(datatablesRequest , function(k,v){
                        aoData.push({"name": k, "value": v});
                    })
                }
            })
        });*/
    </script>

@endsection

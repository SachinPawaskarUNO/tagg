@extends('layouts.app')
@section('css')
    <!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://querybuilder.js.org/assets/css/docs.min.css" rel="stylesheet">
    <link href="http://querybuilder.js.org/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

@endsection
@section('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
     {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
     {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}


@endsection
@section('content')
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
    <!--<section class="bs-docs-section clearfix"> -->
    {{--{{ Form::open(['method' => 'post', 'action' => ['RuleEngineController@saveRule', $ruleType]]) }}--}}
    <form id="mainForm" action="{{ action('RuleEngineController@saveRule') }}">

<!--<Rules help in new window/tab>  -->
      <div class="col-md-12"style="padding-left:82.5%">
        <a href="{{url('/help') }}" target="_blank">
          <h7><b><u>How to set rules?</u></b></h7></a>
        </div>

        <div class="col-md-12 col-lg-10 col-lg-offset-1 form-group">
          <label>Rule Selected:</label>{!! Form::select('rule_type', array(null => 'Select...') + $rule_types->all(), null, ['class'=>'form-control ddlType', 'id'=>'ddlRuleType']) !!}</div>
        </div>
        <input id="ruleType" type="hidden" name="ruleType" value="{{ $_GET['rule'] }}"/>
        <div class="col-md-12 col-lg-10 col-lg-offset-1">
            <div id="builder-plugins"></div>
            <div class="btn-group">
                <!-- <button class="btn btn-error parse-sql" type="button" data-target="plugins">Preview Rule SQL</button> -->
                <button class="btn btn-warning reset" type="button" data-target="plugins">Clear Rules</button>
                <button class="btn btn-success set-json" type="button" data-target="plugins">Reset Rules</button>
                <button id="btnSave" class="btn btn-primary parse-json" type="submit" data-target="plugins">Save Rules</button>
                <button id="btnRun" type="button" href="{{ action('RuleEngineController@runRule') }}" class="btn btn-default">Run Rule Workflow</button>

            </div>
            <br/>
            <input id="ruleSet" type="hidden" name="ruleSet" value="" size="100"/>
            <br/>
            <br/>
            <br/>
            <!-- <div id="querybuilder"></div> -->
        </div>


    </form>
{{--    {{ Form::close() }}--}}

    <!-- </section> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/css/bootstrap-datepicker3.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.0.7/css/bootstrap-slider.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/css/selectize.bootstrap3.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/awesome-bootstrap-checkbox/1.0.0/awesome-bootstrap-checkbox.css"
          rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/jQuery-QueryBuilder@2.4.3/dist/css/query-builder.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.0.7/bootstrap-slider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jQuery-QueryBuilder@2.4.3/dist/js/query-builder.standalone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sql-parser@0.5.0/browser/sql-parser.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.6/interact.min.js"></script>
    <script src="{{ asset('querybuilder/rulebuilder.js') }}" type="text/javascript"></script>
    <style>
        .code-popup {
            max-height: 500px;
        }

        .modal-backdrop {
            z-index: -1;
        }
        .ddlType {
            width: 50%;
        }
    </style>
    <!-- <script>alert('Contact form scripts');</script> -->
    <script>
        $('#ddlRuleType').val({{ $_GET['rule'] }});

        @if ($rule)
        var rules_plugins = {!!  htmlspecialchars_decode($rule, ENT_NOQUOTES) !!};
        @else
        var rules_plugins = {
        'condition': 'AND',
            'rules': [
                {
                    'id': 'dollar_amount',
                   'field': 'dollar_amount',
                    'type': 'double',
                    'input': 'number',
                    'operator': 'equal',
                    'value': '0'
                }
                ],
                'not': false,
                'valid': true
        };
        @endif


        $('#ddlRuleType').change(function () {
            var ddlValue = $(this).val();
            $('#ruleType').val(ddlValue);
            window.location.href = '{{ action('RuleEngineController@index') }}?rule=' + ddlValue;
        });

        $('#btnRun').on('click', function () {
            var iRuleType = $('#ruleType').val();
            window.location.href = '{{ action('RuleEngineController@runRule') }}?rule=' + iRuleType;

        });

        $('#btnSave').on('click', function () {
            var target = $(this).data('target');
            var result = $('#builder-' + target).queryBuilder('getRules');
            if (!$.isEmptyObject(result)) {
                $('#ruleSet').val(format4popup(result));
                /*bootbox.alert({
                    title: $(this).text(),
                    message: '<pre class="code-popup">' + format4popup(result) + '</pre>'
                });*/
            }
        });

        /*
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
                        id: 'requester_type',
                        operator: 'equal',
                        value: 2
                    }, {
                        id: 'requester_type',
                        operator: 'equal',
                        value: 6
                    }, {
                        id: 'requester_type',
                        operator: 'not_equal',
                        value: 1
                    }]
                }, {
                    condition: 'AND',
                    rules: [{
                        id: 'requester',
                        operator: 'equal',
                        value: 'Naggy Group 1'
                    }, {
                        id: 'requester',
                        operator: 'equal',
                        value: 'Naggy Group 2'
                    }, {
                        id: 'amount',
                        operator: 'less_or_equal',
                        value: 50.00
                    }]
                }]
        };
*/
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
                id: 'needed_by_date',
                label: 'Date Needed',
                type: 'datetime',
                validation: {
                    format: 'MM/DD/YYYY'
                },
                plugin: 'datepicker',
                // operators: ['less_or_equal', 'greater_or_equal', 'greater', 'less', 'between', 'not_between'],
                operators: ['less_or_equal', 'greater_or_equal', 'greater', 'less'],
                plugin_config: {
                    format: 'mm/dd/yyyy',
                    todayBtn: 'linked',
                    todayHighlight: true,
                    autoclose: true
                }
            }, {
                id: 'requester',
                label: 'Requester Name',
                type: 'string',
                operators: ['equal', 'not_equal', 'contains', 'not_contains', 'begins_with', 'not_begins_with', 'ends_with', 'not_ends_with']
            }, {
                id: 'requester_type',
                label: 'Requester Type',
                type: 'integer',
                input: 'select',
                values: {
                    1: 'Animal Welfare',
                    2: 'Arts, Culture & Humanities',
                    3: 'Civil Rights, Social Action & Advocacy',
                    4: 'Community Improvement',
                    5: 'Corporate Giving',
                    6: 'Education K-12',
                    7: 'Environment',
                    8: 'Faith/Religious',
                    9: 'Food, Agriculture & Nutrition',
                    10: 'Health Care',
                    11: 'Human Services',
                    12: 'Youth Sports/Activities',
                    13: 'Others'
                },
                //operators: ['equal', 'not_equal', 'in', 'not_in']
                operators: ['equal', 'not_equal']
            }, {
                id: 'tax_exempt',
                label: 'Tax Exempt',
                type: 'boolean',
                input: 'radio',
                values: {
                    1: 'Yes',
                    0: 'No'
                },
                operators: ['equal', 'not_equal']
            }, {
                id: 'dollar_amount',
                label: 'Dollar Amount',
                type: 'double',
                operators: ['less_or_equal', 'greater_or_equal', 'greater', 'less', 'equal', 'not_equal'],
                validation: {
                    min: 0,
                    step: 0.01
                }
            }],

            rules: rules_plugins
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

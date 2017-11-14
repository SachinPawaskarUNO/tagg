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
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>


    <!--<section class="bs-docs-section clearfix"> -->
    {{--{{ Form::open(['method' => 'post', 'action' => ['RuleEngineController@saveRule', $ruleType]]) }}--}}


        <form id="budgetNoticeForm" action="{{ action('RuleEngineController@saveBudgetNotice') }}">
                            <br/>
                <div class="col-md-12 col-lg-10 col-lg-offset-1 form-group">



                <table width="100%" style="background-color:#f9a825">

                    <tr>
                    <td align="center" bgcolor="#f9a825">

<<<<<<< HEAD
                        <h1 style="color:white">Basic Settings</h1>
=======
                        <h1 style="color:white"><label>Basic Settings</label></h1>
>>>>>>> a6bfe856b2cba5ef0d06025eac83792371d5dfd8

                    </td>
                    </tr>

                    </table>


                <table width="100%" style="background-color:#fffde7" frame="border" bordercolor="#ffcc80">
                    <tr>
                        <td>&nbsp; </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <label style="cursor: help;"
                                   title="Enter your estimated monthly budget. Requests that would put you above your monthly budget will be removed from pending approval. NOTE: A budget of 0.00 will disable this functionality.">
                                Monthly Budget:</label>&nbsp;

                            <input id="monthlyBudget" type="number" name="monthlyBudget" pattern="[0-9]?"
                                   min="0"
                                   step="1" required value="{{ $monthlyBudget }}" size="10"/>
                        </td>


                        <td align="center">
                            <label style="cursor: help;"
                                   title="Enter your minimum days notice. Requests that need to be fulfilled before your business can fulfill them will be automatically declined.">
                                Required Days Notice: &nbsp;</label>

                            <input id="daysNotice" type="number" min="0" step="1" name="daysNotice" required
                                   value="{{ $daysNotice }}" size="10"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center"> <br></td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center">
                            <div class="col-md-12 col-lg-10 col-lg-offset-1">
                                <button id="btnSaveBudgetNotice" class="btn btn-primary" type="submit">Save
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" align="center"> <br></td>
                    </tr>
                </table>
            </div>

        </form>
    </div>
<<<<<<< HEAD
=======


    <form id="budgetNoticeForm" action="{{ action('RuleEngineController@saveBudgetNotice') }}">
        <br/>

            <table width="100%" style="background-color:#ffffff" >
                <tr>
                    <td align="center">
                        <a href="{{url('/help') }}" target="_blank">
                            <h1><u><b>How to set rules&nbsp;<span class="glyphicon glyphicon-question-sign"></span></b></u></h1>
                        </a>
                    </td>
                </tr>
            </table>
            <br>
    </form>
>>>>>>> a6bfe856b2cba5ef0d06025eac83792371d5dfd8
    <form id="mainForm" action="{{ action('RuleEngineController@saveRule') }}">

        <div class="col-md-12 col-lg-10 col-lg-offset-1 form-group">
            <br>
           <table width="100%" style="background-color:#f9a825">
                <tr>
                    <td align="center" bgcolor="#f9a825">

                        <h1 style="color:white"> <label for="ddlRuleType">Global Business Rules (Admin Only)</label></h1>

                    </td>
                </tr>
           </table>

            <table width="100%" style="background-color:#fffde7" frame="vsides" bordercolor="#ffcc80" >
                   <tr>
                       <td colspan="4">&nbsp;</td>
                   </tr>
                <tr>

                        <td align="right">
                            <label for="ddlRuleType">Select Rule To Edit:</label>
                        </td>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        &nbsp;
                    </td>
                    <td width="50%">
                            {!! Form::select('rule_type', array(null => 'Select...') + $rule_types->all(), null, ['class'=>'form-control ddlType', 'id'=>'ddlRuleType', 'name'=>'ddlRuleType']) !!}
                        </td>
                    </tr>
                   <tr>
                       <td colspan="4">&nbsp;</td>
                   </tr>
                </table>
            </div>
            <!--<Rules help in new window/tab>  -->
<<<<<<< HEAD
                <a href="{{url('/help') }}" target="_blank">
                    <h1 style="padding-left:82.5%"><b><u>How to set rules?</u></b></h1>
                </a>
=======
              <!--  <a href="{{url('/help') }}" target="_blank">
                    <h1 style="padding-left:82.5%"><b><u>How to set rules?</u></b></h1>
                </a>-->
>>>>>>> a6bfe856b2cba5ef0d06025eac83792371d5dfd8

        </div>
        <input id="ruleType" type="hidden" name="ruleType" value="{{ $_GET['rule'] }}"/>
        <div class="col-md-12 col-lg-10 col-lg-offset-1">
            <div id="builder-plugins"></div>
            <div class="btn-group">
                <!-- <button class="btn btn-error parse-sql" type="button" data-target="plugins">Preview Rule SQL</button> -->
                <button class="btn btn-warning reset" type="button" data-target="plugins">Clear Rules</button>
                <button class="btn btn-success set-json" type="button" data-target="plugins">Reset Rules</button>
                <button id="btnSave" class="btn btn-primary parse-json" type="button" data-target="plugins">Save Rules
                </button>
                <button id="btnRun" type="button" href="{{ action('RuleEngineController@manualRunRule') }}"
                        class="btn btn-default">Run Rule Workflow
                </button>
                <button id="btnRunBudget" type="button" href="{{ action('RuleEngineController@runBudgetCheckRule') }}"
                        class="btn btn-default">Run Budget
                </button>
                <button id="btnRunMinimumNoticeCheckRule" type="button"
                        href="{{ action('RuleEngineController@runMinimumNoticeCheckRule') }}"
                        class="btn btn-default">Run Required Days Notice
                </button>
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
                        'value': '0.00'
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
            window.location.href = '{{ action('RuleEngineController@manualRunRule') }}?rule=' + iRuleType;
        });

        $('#btnRunBudget').on('click', function () {
            window.location.href = '{{ action('RuleEngineController@runBudgetCheckRule') }}';
        });

        $('#btnRunMinimumNoticeCheckRule').on('click', function () {
            window.location.href = '{{ action('RuleEngineController@runMinimumNoticeCheckRule') }}';
        });

        $('#btnSave').on('click', function () {
            var target = $(this).data('target');
            var result = $('#builder-' + target).queryBuilder('getRules');
            if (!$.isEmptyObject(result)) {
                $('#ruleSet').val(format4popup(result));
                document.getElementById("mainForm").submit();
                /*bootbox.alert({
                    title: $(this).text(),
                    message: '<pre class="code-popup">' + format4popup(result) + '</pre>'
                });*/
            }
        });

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
                type: 'date',
                validation: {
                    format: 'MM/DD/YYYY'
                },
                plugin: 'datepicker',
                operators: ['less_or_equal', 'greater_or_equal', 'greater', 'less', 'between', 'not_between'],
                // operators: ['less_or_equal', 'greater_or_equal', 'greater', 'less'],
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
                input: 'checkbox',
                values: {
                    {!!  htmlspecialchars_decode($requesterTypes, ENT_NOQUOTES) !!}
                },
                operators: ['in', 'not_in']
                // operators: ['equal', 'not_equal']
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
        /*
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

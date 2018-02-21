@extends('layouts.app')
@section('css')
@endsection
@section('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>

@endsection
@section('content')


    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>

    <style>

        tbody
        {
            outline: thin solid #bdbdbd;

        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Donation Preference Settings</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="col-md-12 col-lg-10 col-lg-offset-1 form-group">
    <div class="col-md-12 col-lg-10 col-lg-offset-1 form-group">

        <!--<section class="bs-docs-section clearfix"> -->
        {{--{{ Form::open(['method' => 'post', 'action' => ['RuleEngineController@saveRule', $ruleType]]) }}--}}


        <form id="budgetNoticeForm" action="{{ action('RuleEngineController@saveBudgetNotice') }}">

            {{ csrf_field() }}




                <table width="100%">

                    <tr>
                        <td align="left" bgcolor="#f5f5f5" style="padding-left: 10px" >


                            <h1><label>Basic Settings</label></h1>


                        </td>
                    </tr>

                </table>
                <table width="100%" style="background-color:#fafafa">
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="background-color:#fafafa">
                            <label style="cursor: help;"
                                   title="Enter your estimated monthly budget. Requests that would put you above your monthly budget will be removed from pending approval. NOTE: A budget of 0.00 will disable this functionality.">
                                Monthly Budget:</label>&nbsp;

                            <input id="monthlyBudget" type="text" name="monthlyBudget"
                                   pattern="(?=.{1,10}$)\d{1,3}(?:,\d{3})+|(?=.{1,8}$)\d+"
                                   min="0"
                                   step="1" required value="{{ number_format($monthlyBudget, 0, '.', ',' ) }}"/>
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
                        <td colspan="10" align="center"><br></td>
                    </tr>
                    <tr>
                        <td colspan="10" align="center">

                                <button id="btnSaveBudgetNotice" class="btn btn-primary" type="submit">Save
                                </button>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" align="center"><br></td>
                    </tr>
                </table>

        </form>
            </div>



    <div class="col-md-12 col-lg-10 col-lg-offset-1 form-group">
        <form id="mainForm" action="{{ action('RuleEngineController@saveRule') }}">
            {{ csrf_field() }}

            @if (Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN)

                <table width="100%">
                    <tr>
                        <td align="left" bgcolor="#f5f5f5" style="padding-left: 10px" >

                            <h1><label for="ddlRuleType">Global Business Rules (Admin Only)</label></h1>
                        </td>
                        <td align="center" bgcolor="#f5f5f5" style="padding-right: 10px;padding-top: 0px">

                                 <a href="{{url('/help') }}" target="pdf-frame">
                                        <h5 align="right" vertical-align="middle"><u><b>How to set rules&nbsp;<span class="glyphicon glyphicon-question-sign"></span></b></u></h5>
                                    </a>
                       </td>
                    </tr>
                </table>

                <table width="100%" style="background-color:#fafafa">
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>

                        <td align="right" style="padding-right: 20px" >
                            <label for="ddlRuleType">Select Rule To Edit:</label>
                        </td>

                        <td>
                            &nbsp;
                        </td>
                        <td width="50%" align="left">
                            {!! Form::select('rule_type', array(null => 'Select...') + $rule_types->all(), null, ['class'=>'form-control ddlType', 'id'=>'ddlRuleType', 'name'=>'ddlRuleType']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                </table>
            <!--<Rules help in new window/tab>  -->


            <input id="ruleType" type="hidden" name="ruleType" value="{{ $_GET['rule'] }}"/>

                <div id="builder-plugins" style="background-color:#bbdefb"></div>
                <div class="btn-group">
                    <!-- <button class="btn btn-error parse-sql" type="button" data-target="plugins">Preview Rule SQL</button> -->
                    <button class="btn backbtn reset" type="button" data-target="plugins">Clear Rules</button>
                    <button class="btn btn-success set-json" type="button" data-target="plugins">Reset Rules</button>
                    <button id="btnSave" class="btn savebtn parse-json" type="button" data-target="plugins">Save Rules
                    </button>
                </div>
                    <!-- Run Rule buttons hidden now that rules execute automatically-->
                    <button id="btnRun" type="button" href="{{ action('RuleEngineController@manualRunRule') }}"
                            class="btn btn-default" style="visibility: hidden;">Run Rule Workflow
                    </button>
                    {{--<button id="btnRunBudget" type="button" href="{{ action('RuleEngineController@runBudgetCheckRule') }}"
                            class="btn btn-default">Run Budget
                    </button>
                    <button id="btnRunMinimumNoticeCheckRule" type="button"
                            href="{{ action('RuleEngineController@runMinimumNoticeCheckRule') }}"
                            class="btn btn-default">Run Required Days Notice
                    </button>--}}


                <input id="ruleSet" type="hidden" name="ruleSet" value="" size="100"/>

                <!-- <div id="querybuilder"></div> -->

        </form>
    </div>
    @endif
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
        var el = document.getElementById('monthlyBudget');
        el.addEventListener('keyup', function (event) {
            if (event.which >= 37 && event.which <= 40) return;
            this.value = this.value.replace(/\D/g, '')
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
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
                // 'bt-checkbox',
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
                label: 'Organization Requester Type',
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

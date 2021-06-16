@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_list_title',["app_name" => __('app.app_name'),"module"=> __('app.enquiry')])}}
@endsection
@push('externalCssLoad')
@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>{{trans('app.enquiry')}} Management</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}">{{trans('app.admin_home')}}</a></li>
                <li class="active">{{trans('app.enquiry')}} Listing</li>
            </ol>
        </div>
        <div class="main-content container-fluid">

            <!-- Caontain -->
            <div class="panel panel-default panel-border-color panel-border-color-primary pull-left">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="activity-but activity-space pull-left">
                            <div class="pull-left">
                                <a href="javascript:void(0);" class="btn btn-warning func_SearchGridData"><i
                                            class="icon mdi mdi-search"></i> Search</a>
                            </div>
                            <div class="pull-left">
                                <a href="javascript:void(0);" class="btn btn-danger func_ResetGridData"
                                   style="margin-left: 10px;">Reset</a>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="deta-table enquiry-table pull-left">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default panel-table">
                                <div class="panel-body">
                                    <table id="dataTable"
                                           class="table display dt-responsive responsive nowrap table-striped table-hover table-fw-widget"
                                           style="width: 100%;">
                                        <thead>

                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>State</th>
                                            <th>City</th>
                                            @if(Auth::user()->role == "admin")
                                            <th>Cancer Type</th>
                                            @endif
                                            <th class="no-sort">Action</th>
                                        </tr>

                                        </thead>
                                        <thead>
                                        <tr>
                                            <th>
                                                <input type="text" name="filter[name]" style="width: 80px;" id="first_name" value="" />
                                            </th>
                                            <th>
                                                <input type="text" name="filter[email]" style="width: 80px;" id="email"
                                                value="" />
                                            </th>
                                            <th>
                                                <input type="text" name="filter[state]" style="width: 80px;" id="state"
                                                value="" />
                                            </th>
                                            <th>
                                                <input type="text" name="filter[city]" style="width: 80px;" id="city"
                                                value="" />
                                            </th>
                                            @if(Auth::user()->role == "admin")
                                            <th>
                                                <select name="filterSelect[cancer_type_id]" id="cancer_type_id" style="width: 80px;">
                                                    <option value="">{{trans('app.select')}}</option>
                                                    @if(count($cancerTypeData) > 0)
                                                        @foreach($cancerTypeData as $row)
                                                            <option value="{{$row->id}}">{{$row->type}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </th>
                                            @endif
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('externalJsLoad')
<script src="{{url('js/appDatatable.js')}}"></script>
<script src="{{url('js/modules/enquiry.js')}}"></script>
@endpush
@push('internalJsLoad')
<script>
    app.enquiry.init();
</script>
@endpush
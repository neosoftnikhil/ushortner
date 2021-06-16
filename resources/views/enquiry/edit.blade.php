@extends('layouts.common')
@section('pageTitle')
    {{__('app.default_edit_title',["app_name" => __('app.app_name'),"module"=> __('app.doctor')])}}
@endsection
@push('externalCssLoad')
@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
            <div class="page-head">
            <h2>{{trans('app.enquiry')}} {{trans('app.management')}}</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/dashboard')}}">{{trans('app.admin_home')}}</a></li>
                <li><a href="{{url('/enquiry/list')}}">{{trans('app.enquiry')}} {{trans('app.management')}}</a></li>
                <li class="active">{{trans('app.edit')}} {{trans('app.plan')}}</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">{{trans('app.add')}} {{trans('app.plan')}}</div>
                        <div class="panel-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{url('/plan/store')}}" name="app_edit_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                <div class="form-group">
                                    <label class="col-sm-4 float-left">Plan Description <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-10">
                                        <textarea name="description" id="description" placeholder="Plan Description" class="form-control input-sm required">{{ $planData->description ?? '' }}</textarea>
                                    </div>
                                </div>
                                @if (!empty($documents))
                                <div class="form-group">
                                    <label class="col-sm-4 float-left">Old Plans <span class="error">*</span></label>
                                    <div class="col-sm-6 col-md-10">
                                        <ul>
                                        @foreach ($documents as $item)
                                            <li>
                                                <a href="{{url('/download/' .$item->id )}}">{{ $item->file_name }}</a>
                                            </li>  
                                        @endforeach    
                                        </ul>                                        
                                    </div>
                                </div>
                                @endif
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value="{{$details->id}}" />
                                <div class="col-sm-6 col-md-8 savebtn">
                                    <p class="text-right">
                                        <button type="submit" class="btn btn-space btn-info btn-lg">Add {{trans('app.plan')}}</button>
                                        <a href="{{url('/enquiry/')}}" class="btn btn-space btn-danger btn-lg">Cancel</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('externalJsLoad')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endpush
@push('internalJsLoad')
<script type="text/javascript">
    CKEDITOR.replace( 'description' );
</script>
@endpush
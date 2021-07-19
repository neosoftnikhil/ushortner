@extends('layouts.common')
@section('pageTitle')
    {{__('app.dashboard_title',["app_name"=> __('app.app_name')])}}
@endsection
@push('externalCssLoad')
@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>Upgrade Plan</h2>
            <ol class="breadcrumb">
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                        <div class="panel panel-default panel-border-color panel-border-color-primary">
                            <div class="panel-body">
                                <div class="ajax_error_msg">
                                </div>
                                <form action="javascript:void(0);" novalidate name="app_add_form" id="app_form" style="border-radius: 0px;" method="post" class="form-horizontal group-border-dashed">

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label"></label>
                                        <div class="col-sm-6 col-md-4">
                                            <select name="plan_id" class="form-control input-sm required">
                                                <option value="">Select Plan</option>
                                                @if(count($planData) > 0)
                                                    @foreach($planData as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>    
                                        </div>
                                    </div>

                                    {{ csrf_field() }}
                                    <div class="col-sm-6 col-md-8 savebtn">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-info btn-lg">Upgrade Plan</button>
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
@endpush
@push('internalJsLoad')
<script type="text/javascript">
    $(document).ready(function () {
        app.validate.init();
        
        $("#app_form").submit(function(e) {
            e.stopPropagation();
            if (!$(this).valid()) {
                return false;
            }
            var formData = new FormData(this);
            $.ajax({
                cache: false,
                url: baseUrl + 'user_plan/store',
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,                            
                success: function (response) {
                    console.log(response);
                    if (response.status_code == 1) {
                        window.location.href = response.url;
                    } else {
                        $(".ajax_error_msg").html(response.error_message_html);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });
    });    
</script>
@endpush
@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header">{{ __('Book Appointment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/store')}}" id="app_form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control required" name="full_name" value="{{ old('full_name') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control required email" name="email" value="{{ old('email') }}">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control required" name="password" autocomplete="new-password">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control required contact_number" name="contact_number" autocomplete="contact_number">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control required" name="state" autocomplete="state">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control required" name="city" autocomplete="city">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control required" name="address" autocomplete="address"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pincode" class="col-md-4 col-form-label text-md-right">{{ __('Pincode') }}</label>

                            <div class="col-md-6">
                                <input id="pincode" type="text" class="form-control required" name="pincode" autocomplete="pincode">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cancer_type_id" class="col-md-4 col-form-label text-md-right">{{ __('Type Of Cancer') }}</label>

                            <div class="col-md-6">
                                <select class="form-control input-sm required" name="cancer_type_id" id="cancer_type_id">
                                    <option value="">Select Cancer Type</option>
                                    @if(count($cancerTypeData) > 0)
                                        @foreach($cancerTypeData as $row)
                                            <option value="{{$row->id}}">{{$row->type}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Documents') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="document[]" multiple class="form-control required">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('internalJsLoad')
<script type="text/javascript">
    var validations = {
        rules:{
            contact_number:{
                minlength : '10',
                maxlength : '10',
            }
        },
        messages:{
            contact_number:{
                minlength : 'Mobile Number should be atleast 10 Digit long',
                maxlength : 'Mobile Number should not be greater 10 Digit',
            },
        },
        errorPlacement: function (error, element) {
            element.after(error);
        }
    };
    app.validate.init(validations);
</script>
@endpush
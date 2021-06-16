<!DOCTYPE html>
<html>
    <head>
        <title>{{__('app.app_name')}} : Enquiry Plan Information</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body style="margin: 0;padding: 0;width: 100%;display: table;font-weight: 100;height: 100%;">
        <div style="text-align: center;display: table-cell;vertical-align: middle;">
            <div style="width: 450px;margin: 0 auto;">
                <div style="text-align: center; border-bottom: 1px lightgrey solid;">
                    <span>
                        <a href="{{url('/dashboard')}}"><img src="{{url('img/logo.png')}}"/></a>
                    </span>
                </div>
                <div style="text-align: center;border-bottom: 1px lightgrey solid;">
                    <h2><strong>Enquiry Plan Information</strong></h2>
                </div>
                <div style=" text-align: center;display: inline-block;border-bottom: 1px lightgrey solid;">
                    <p>Hello {{$name}},</p>
                    <p>Please find the plan in the attachement. Doctor Details are below</p>
                    <p><b>Doctor:</b> {{$doctorName}}</p>
                    <p><b>Doctor Email:</b> {{$doctorEmail}}</p>                    
            </div>
                <p>Thanks,</p>
                <p>{{__('app.app_name')}}</p>
        </div>
        </div>
    </body>
</html>
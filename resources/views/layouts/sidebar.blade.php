<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">{{trans('app.admin_home')}}</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">{{trans('app.menu')}}</li>
                        <li class="{{$dashboardTab ?? ''}}" title="Dashboard"><a href="{{url('/dashboard')}}"><i
                                        class="icon mdi mdi-home"></i><span>{{trans('app.admin_home')}}</span></a>
                        </li>                        
                        @if(Auth::user()->role == "admin")
                            <li title="cancer_type" class="{{$cancerTypeTab ?? ''}}"><a href="{{url('/cancer_type')}}"><i
                                            class="icon mdi mdi-face"></i></i><span>{{trans('app.cancer_type')}}</span></a>
                            </li>
                            <li title="doctor" class="{{$userTab ?? ''}}"><a href="{{url('/doctor')}}"><i
                                            class="icon mdi mdi-face"></i></i><span>{{trans('app.doctor')}}</span></a>
                            </li>
                        @endif
                        <li title="enquiry" class="{{$enquiryTab ?? ''}}"><a href="{{url('/enquiry')}}"><i
                                            class="icon mdi mdi-face"></i></i><span>{{trans('app.enquiry')}}</span></a>
                        </li>
                        
                    </ul>
                    </li>
                    </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
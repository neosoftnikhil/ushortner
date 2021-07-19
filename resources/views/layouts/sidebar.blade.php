<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">{{trans('app.admin_home')}}</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">{{trans('app.menu')}}</li>
                        @if($currentPlan !== 'unlimited')
                        <li class="{{$upgradePlanTab ?? ''}}" title="upgradePlan"><a href="{{url('/upgrade-plan')}}"><i
                                        class="icon mdi mdi-home"></i><span>Upgrade Plan</span></a>
                        </li>
                        @endif
                        <li title="shortner" class="{{$shortnerTab ?? ''}}"><a href="{{url('/shortner')}}"><i
                                        class="icon mdi mdi-face"></i></i><span>{{trans('app.shortner')}}</span></a>
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
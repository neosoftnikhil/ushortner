<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Shortner;
use App\Models\UserPlan;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $currentPlan = UserPlan::getCurrentPlan();
        if ($currentPlan == 'unlimited') {
            return redirect('shortner');
        }
        $plan = Plan::get();
        $data['upgradePlanTab'] = 'active';
        $data['planData'] = $plan;
        $data['currentPlan'] = $currentPlan;
        return view('upgrade-plan')->with($data);
    }

    /**
     * redirect to main url by short url
     *
     * @param string $shortCode
     * @return void
     */
    public function redirectShortUrl($shortCode) {
        $shortUrl = url('/').'/'.$shortCode;
        $url = Shortner::where('short_url', $shortUrl)->first();
        if (empty($url->url)) {
            return abort(404);
        }
        return redirect($url->url);
    }
}

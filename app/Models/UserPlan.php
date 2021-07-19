<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserPlan extends Model
{
    protected $table = 'user_plan';
    protected $primaryKey = 'id';    


    public function Plan() {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }

    public static function add($models = []) {
        $userPlan = new UserPlan();
        $userPlan->user_id = Auth::user()->id;
        $userPlan->plan_id = $models['plan_id'];
        $userPlan->created_at = date('Y-m-d H:i:s');
        $userPlan->updated_at = date('Y-m-d H:i:s');
        return $userPlan->save();
    }

    public static function getCurrentPlan()
    {
        $plans = UserPlan::with(['Plan'])->where('user_id', Auth::user()->id)->get();
        $planRange = [];
        foreach($plans as $item) {
            if($item->Plan['range'] == 'unlimited') {
                return $item->Plan['range'];
            }
            $planRange[] = (int)$item->Plan['range'];
        }

        return array_sum($planRange);
    }
}

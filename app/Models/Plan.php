<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Plan extends Model
{
    protected $table = 'plan';
    protected $primaryKey = 'id';

    /**
     * add plan
     *
     * @param array $models
     * @return void
     */
    public static function add($models = []) {

        $planData = Plan::where('enquiry_id', $models['id'])->first();
        if ($planData) {
            $plan = Plan::find($planData->id);
        } else {
            $plan = new Plan;
            $plan->created_at = date('Y-m-d H:i:s');            
        }
        $plan->doctor_id = Auth::user()->id;
        $plan->enquiry_id = $models['id'];
        $plan->description = $models['description'];
        $plan->updated_at = date('Y-m-d H:i:s');
        $planId = $plan->save();
        if ($planId) {
            return $plan;
        }

        return false;
    }
}

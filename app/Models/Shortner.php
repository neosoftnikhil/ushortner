<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Shortner extends Model
{
    use SoftDeletes;
    protected $table = 'shortner';
    protected $primaryKey = 'id';

    public static function checkPlanValidity()
    {
        $currentPlan = UserPlan::getCurrentPlan();
        if ($currentPlan == 0) {
            return false;
        }
        $userUrlCount = Shortner::where('user_id', Auth::user()->id)->count();
        if ($currentPlan == 'unlimited') {
            return true;
        }

        if ($currentPlan > $userUrlCount) {
            return true;
        }

        return false;
    }
}

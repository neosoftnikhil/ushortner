<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Validator;
use DB;

class UserPlanController extends Controller
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
     * Validation of add and edit action customeValidate
     *
     * @param array $data
     * @return mixed
     */
    public function customeValidate($data)
    {
        $rules = array(
            'plan_id' => 'required',            
        );        
        return Validator::make($data, $rules);
    }

    /**
     * Store a newly created userPlan in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        $validations = $this->customeValidate($request->all());
        if ($validations->fails()):
            $errorMessageHtml = view('datatable.controller_html',["mode" => "error_message_html" ,"errors" => json_decode($validations->errors(), true)])->render();
            $return = ['status_code' => 0, 'error_message_html' => $errorMessageHtml];
            return $return;
        endif;
        
        $returnarray['status_code'] = 0;
        // Start Communicate with database
        DB::beginTransaction();
        try{
            $returnarray['status_code'] = 1;
            $returnarray['url'] = url('shortner');
            UserPlan::add($request->all());
            DB::commit();
            $request->session()->flash('alert-success','Plan added successfully!');
        } catch (\Throwable $e) {
            //exception handling
            DB::rollback();
            $errorMessageHtml = view('datatable.controller_html',["mode" => "error_message_html" ,"errors" => [[$e->getMessage()]]])->render();
            $returnarray['error_message_html'] = $errorMessageHtml;
        }
        return $returnarray;
    }
}

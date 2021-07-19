<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shortner as ModelsShortner;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Validator;
use Shortner;
use Auth;
use DB;

class ShortnerController extends Controller
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
     * Display a listing of the shortner.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData = Shortner::view();
        return view('shortner.list', $viewData);
    }

    /**
     * @param Request $request
     * @return mixed
     * @author Nikhil.Jain
     */
    public function datatable(Request $request)
    {
        return Shortner::getDataTable($request);
    }

    /**
     * Show the form for creating a new shortner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formData = Shortner::create();
        return view('shortner.add', $formData);
    }

    /**
     * Display the specified shortner.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editFormData = Shortner::edit($id);
        return view('shortner.edit', $editFormData);
    }

    /**
     * Validation of add and edit action customeValidate
     *
     * @param array $data
     * @param string $mode
     * @return mixed
     */
    public function customeValidate($data)
    {
        $rules = array(
            'url' => 'required|url'            
        );
        return Validator::make($data, $rules);
    }

    /**
     * Store a newly created shortner in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {

        $validations = $this->customeValidate($request->all());
        if ($validations->fails()):
            $errorMessageHtml = view('datatable.controller_html',["mode" => "error_message_html" ,"errors" => json_decode($validations->errors(), true)])->render();
            return  ['status_code' => 0, 'error_message_html' => $errorMessageHtml];            
        endif;

        if (ModelsShortner::checkPlanValidity() === false) {
            $errorMessageHtml = view('datatable.controller_html',["mode" => "error_message_html" ,"errors" => [['Your Plan is expire. Please upgrade plan.']]])->render();
            return ['status_code' => 0, 'error_message_html' => $errorMessageHtml];
        }

        $returnarray['status_code'] = 0;
        // Start Communicate with database
        DB::beginTransaction();
        try{
            $returnarray['status_code'] = 1;
            $returnarray['url'] = url('shortner');            
            Shortner::insertAndUpdateShortner($request->all());
            DB::commit();
            $request->session()->flash('alert-success', __('app.default_add_success',["module" => __('app.shortner')]));            
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessageHtml = view('datatable.controller_html',["mode" => "error_message_html" ,"errors" => [[$e->getMessage()]]])->render();
            $returnarray['error_message_html'] = $errorMessageHtml;
        }
        
        return $returnarray;        
    }

    /**
     * Update the specified shortner in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(request $request)
    {
        $validations = $this->customeValidate($request->all());
        if ($validations->fails()):
            $errorMessageHtml = view('datatable.controller_html',["mode" => "error_message_html" ,"errors" => json_decode($validations->errors(), true)])->render();
            return ['status_code' => 0, 'error_message_html' => $errorMessageHtml];            
        endif;

        $returnarray['status_code'] = 0;
        // Start Communicate with database
        DB::beginTransaction();
        try{
            $returnarray['status_code'] = 1;
            $returnarray['url'] = url('shortner');
            Shortner::insertAndUpdateShortner($request->all());
            DB::commit();
            $request->session()->flash('alert-success', __('app.default_edit_success',["module" => __('app.shortner')]));
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessageHtml = view('datatable.controller_html',["mode" => "error_message_html" ,"errors" => [[$e->getMessage()]]])->render();
            $returnarray['error_message_html'] = $errorMessageHtml;
        }

        return $returnarray;    
    }

    
    /**
     * Delete the specified shortner in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        $deleteShortner = Shortner::deleteShortner($request->id);
        if ($deleteShortner) {
            $request->session()->flash('alert-success', __('app.default_delete_success',["module" => __('app.shortner')]));
        } else {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.shortner'),"action"=>__('app.delete')]));
        }
        echo 1;
    }

    /**
     * Update status to the specified user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(request $request)
    {
        // Start Communicate with database
        DB::beginTransaction();
        try{
            $updateUser = Shortner::updateStatus($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
        }

        if ($updateUser) {
            $request->session()->flash('alert-success', __('app.default_status_success',["module" => __('app.shortner')]));
        } else {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.shortner'),"action"=>__('app.change_status')]));
        }
        echo 1;
    }
}

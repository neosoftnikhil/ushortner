<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Event;
use Hash;
use CancerType;
use DB;

class CancerTypeController extends Controller
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
     * Display a listing of the cancerType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData = CancerType::view();
        return view('cancer_type.list', $viewData);
    }

    /**
     * @param Request $request
     * @return mixed
     * @author Nikhil.Jain
     */
    public function datatable(Request $request)
    {
        return CancerType::getDataTable($request);
    }

    /**
     * Show the form for creating a new cancerType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formData = CancerType::create();
        return view('cancer_type.add', $formData);
    }

    /**
     * Display the specified cancerType.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editFormData = CancerType::edit($id);
        return view('cancer_type.edit', $editFormData);
    }

    /**
     * Validation of add and edit action customeValidate
     *
     * @param array $data
     * @param string $mode
     * @return mixed
     */
    public function customeValidate($data, $mode)
    {
        $rules = array(
            'type' => 'required|unique:cancer_types,type'            
        );
        if ($mode == "edit") {
            $rules = array(
                'type' => 'required|unique:cancer_types,type,' . $data['id']             
            );  
        }
        $validator = Validator::make($data, $rules);        
        if ($validator->fails()) {
            $errorRedirectUrl = "cancer_type/add";
            if ($mode == "edit") {
                $errorRedirectUrl = "cancer_type/edit/" . $data['id'];
            }
            return redirect($errorRedirectUrl)->withInput()->withErrors($validator);
        }
        return false;
    }

    /**
     * Store a newly created cancerType in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {

        $validations = $this->customeValidate($request->all(), 'add');
        if ($validations) {
            return $validations;
        }

        // Start Communicate with database
        DB::beginTransaction();
        try{
            CancerType::insertAndUpdateCancerType($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('cancer_type/add')->withInput();

        }
        
        $request->session()->flash('alert-success', __('app.default_add_success',["module" => __('app.cancer_type')]));
        return redirect('cancer_type/');        
    }

    /**
     * Update the specified cancerType in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(request $request)
    {
        $validations = $this->customeValidate($request->all(), 'edit');
        if ($validations) {
            return $validations;
        }

        // Start Communicate with database
        DB::beginTransaction();
        try{
            CancerType::insertAndUpdateCancerType($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('cancerType/edit/' . $request->get('id'))->withInput();

        }

        //  if change_redirect_state  exists then cancerType redirect to cancerType profile
        $request->session()->flash('alert-success', __('app.default_edit_success',["module" => __('app.cancer_type')]));
        return redirect('cancer_type/');        
    }

    
    /**
     * Delete the specified cancerType in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        $deleteCancerType = CancerType::deleteCancerType($request->id);
        if ($deleteCancerType) {
            $request->session()->flash('alert-success', __('app.default_delete_success',["module" => __('app.cancer_type')]));
        } else {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.cancer_type'),"action"=>__('app.delete')]));
        }
        echo 1;
    }
}

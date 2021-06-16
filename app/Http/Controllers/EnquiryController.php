<?php

namespace App\Http\Controllers;

use App\Repositories\Contract\CancerTypeInterface;
use Illuminate\Http\Request;
use Validator;
use Enquiry;
use DB;

class EnquiryController extends Controller
{

    protected $cancerTypeRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CancerTypeInterface $cancerTypeInterface)
    {
        $this->cancerTypeRepo = $cancerTypeInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['cancerTypeData'] = $this->cancerTypeRepo->getCollection();
        return view('home', $data);
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
            'document.*' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:10000',
            'email' => 'required|email'
        );

        $messages = [
            'document.*.required' => 'Please upload document',
            'document.*.mimes' => 'Only jpeg,bmp,png,gif,svg,pdf,video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi files are allowed',
            'document.*.max' => 'Sorry! Maximum allowed size for document is 10MB',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $errorRedirectUrl = "/";            
            return redirect($errorRedirectUrl)->withInput()->withErrors($validator);
        }
        return false;
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {

        $validations = $this->customeValidate($request->all());
        if ($validations) {
            return $validations;
        }

        // Start Communicate with database
        DB::beginTransaction();
        try{
            Enquiry::insertAndUpdateEnquiry($request);
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $request->session()->flash('alert-danger', $e->getMessage());
            return redirect('/')->withInput();

        }
        
        $request->session()->flash('alert-success', __('app.default_add_success',["module" => __('app.enquiry')]));
        return redirect('/');        
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $viewData = Enquiry::view();
        return view('enquiry.list', $viewData);
    }

    /**
     * @param Request $request
     * @return mixed
     * @author Nikhil.Jain
     */
    public function datatable(Request $request)
    {
        return Enquiry::getDataTable($request);
    }

    /**
     * Display the specified user.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editFormData = Enquiry::edit($id);
        return view('enquiry.edit', $editFormData);
    }
}

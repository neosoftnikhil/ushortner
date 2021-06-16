<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use DB;
use PDF;
use Storage;
use App\Models\Documents;
use App\Models\Plan;
use App\Models\Enquiry;
use Auth;
use Response;

class PlanController extends Controller
{
    
    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        $requestData = $request->all();
        // Start Communicate with database
        DB::beginTransaction();
        try{
            $plan = Plan::add($requestData);
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $request->session()->flash('alert-danger', $e->getMessage());
            return redirect('/')->withInput();

        }

        if (!$plan) {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.plan'),"action"=>__('app.add')]));
            return redirect('enquiry/edit'. $requestData['id'])->withInput();
        }

        $pdf = PDF::loadView('pdf', ['body' => $requestData['description']]);
        $pdfName = 'plan_'.time().'.pdf';
        Storage::put('public/files/plan/'.$pdfName, $pdf->output());
        
        $documentParam = [];
        $documentParam['entity_id'] = $plan->id;
        $documentParam['entity_type'] = 'plan';
        $documentParam['path'] = '/app/public/files/plan';
        $documentParam['file_name'] = $pdfName;
        Documents::add($documentParam);

        $this->sendMailToClient($plan->id, $requestData['id']);
        
        $request->session()->flash('alert-success', __('app.default_add_success',["module" => __('app.plan')]));
        return redirect('/enquiry');        
    }


    /**
     * send plan mail to client
     *
     * @param [type] $planId
     * @param [type] $enquiryId
     * @return void
     */
    private function sendMailToClient($planId, $enquiryId)
    {
        $document = Documents::where('entity_id', $planId)->where('entity_type','plan')->get();
        $enquiry = Enquiry::where('id', $enquiryId)->first();
        $emailData = [
            'name' => $enquiry->full_name,
            'email' => $enquiry->email,
            'doctorName' => Auth::user()->name,
            'doctorEmail' => Auth::user()->email,
            'viewTemplate' => 'emails.client_plan',
            'subjectLine' => 'Plan of your enquiry',
            'attachments' => $document
        ];
        dispatch(new SendEmailJob($emailData));
    }

    public function download($id)
    {
        $document = Documents::where('id', $id)->first();
        $file = storage_path(). $document->path.'/'.$document->file_name;

        $headers = array(
              'Content-Type: application/pdf',
            );

            return Response::download($file, $document->file_name, $headers);
    }
}

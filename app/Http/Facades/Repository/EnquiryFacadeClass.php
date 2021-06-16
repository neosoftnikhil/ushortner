<?php namespace App\Http\Facades\Repository;

use App\Repositories\Contract\EnquiryInterface;
use App\Models\Documents;
use App\Repositories\Contract\CancerTypeInterface;
use Auth;
use App\Models\Plan;
/**
 * Class EnquiryFacadeClass
 *
 */
class EnquiryFacadeClass
{

    protected $enquiry, $cancerTypeRepo;
    /**
     * Enquiry constructor.
     *
     * @param EnquiryInterface $enquiryRepo
     */
    public function __construct(EnquiryInterface $repo, CancerTypeInterface $cancerTypeInterface)
    {
        $this->enquiry = $repo;
        $this->cancerTypeRepo = $cancerTypeInterface;
    }

    /**
     * @return mixed
     * @author Nikhil.Jain
     */
    public function view() {
        $data['enquiryData'] = $this->enquiry->getCollection();
        $data['cancerTypeData'] = $this->cancerTypeRepo->getCollection();
        $data['enquiryTab'] = "active";
        return $data;
    }

    /**
     * @param $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     * @author Nikhil.Jain
     */
    public function getDataTable($request) {

        // get the fields for enquiry list
        $enquiryData = $this->enquiry->getDatatableCollection();

        // get the filtered data of enquiry list
        $enquiryFilteredData = $this->enquiry->getFilteredData($enquiryData,$request);

        //  Sorting enquiry data base on requested sort order
        $enquiryCount = $this->enquiry->getCount($enquiryFilteredData);

        // Sorting enquiry data base on requested sort order
        $enquirySortData = $this->enquiry->getSortData($enquiryFilteredData,$request);
        
        // get collection of enquiry
        $enquiryData = $this->enquiry->getData($enquirySortData,$request);

        $appData = array();
        foreach ($enquiryData as $enquiryData) {
            $row = array();
            $row[] = $enquiryData->full_name;
            $row[] = $enquiryData->email;
            $row[] = $enquiryData->state;
            $row[] = $enquiryData->city;
            if (Auth::user()->role == "admin") {
                $row[] = $enquiryData->Specialization->type;
            }

            if (Auth::user()->role == "admin" || (!empty($enquiryData->Plan) && $enquiryData->Plan->doctor_id != Auth::user()->id)) {
                $row[] = '';
            } else {
                $row[] = view('datatable.action', ['module' => "enquiry",'id' => $enquiryData->id])->render();
            }            
            $appData[] = $row;
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $enquiryCount,
            'recordsFiltered' => $enquiryCount,
            'data' => $appData,
        ];
    }
    
    /**
     * Display the specified enquiry.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function edit($id)
    {

        $planData = Plan::where('enquiry_id', $id)->first();

        $data['details'] = $this->enquiry->getEnquiryByField($id, 'id');
        if ($planData) {
            $data['planData'] = $planData;
            $data['documents'] = Documents::where('entity_type', 'plan')->where('entity_id', $planData->id)->get();
        }
        $data['enquiryTab'] = "active";
        return $data;
    }
    
    /**
     * Store and Update enquiry in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function insertAndUpdateEnquiry($request) {
        $enquiryData = $this->enquiry->addEnquiry($request->all());
        if($request->hasfile('document'))
         {
            foreach($request->file('document') as $key => $file)
            {
                $name = time().$key.'.'.$file->extension();
                $path = '/files/enquiry';
                $file->move(public_path().$path, $name);
                $documentParam = [];
                $documentParam['entity_id'] = $enquiryData->id;
                $documentParam['entity_type'] = 'enquiry';
                $documentParam['path'] = $path;
                $documentParam['file_name'] = $name;
                Documents::add($documentParam);
            }
         }
         return $enquiryData;
    }


    /**
     * @param $id
     * @return bool
     * @author Nikhil.Jain
     */
    public function deleteEnquiry($id) {
        return $this->enquiry->deleteEnquiry($id);
    }
}
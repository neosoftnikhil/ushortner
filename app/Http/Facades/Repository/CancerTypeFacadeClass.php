<?php namespace App\Http\Facades\Repository;

use App\Repositories\Contract\CancerTypeInterface;

/**
 * Class CancerTypeFacadeClass
 *
 */
class CancerTypeFacadeClass
{

    protected $cancerType;
    /**
     * CancerType constructor.
     *
     * @param CancerTypeInterface $blockedAdjRepo
     */
    public function __construct(CancerTypeInterface $repo)
    {
        $this->cancerType = $repo;
    }

    /**
     * @return mixed
     * @author Nikhil.Jain
     */
    public function view() {
        $data['cancerTypeData'] = $this->cancerType->getCollection();
        $data['masterManagementTab'] = "active open";
        $data['cancerTypeTab'] = "active";
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

        // get the fields for cancerType list
        $cancerTypeData = $this->cancerType->getDatatableCollection();

        // get the filtered data of cancerType list
        $cancerTypeFilteredData = $this->cancerType->getFilteredData($cancerTypeData,$request);

        //  Sorting cancerType data base on requested sort order
        $cancerTypeCount = $this->cancerType->getCount($cancerTypeFilteredData);

        // Sorting cancerType data base on requested sort order
        $cancerTypeSortData = $this->cancerType->getSortData($cancerTypeFilteredData,$request);
        
        // get collection of cancerType
        $cancerTypeData = $this->cancerType->getData($cancerTypeSortData,$request);

        $appData = array();
        foreach ($cancerTypeData as $cancerTypeData) {
            $row = array();
            $row[] = $cancerTypeData->type;
            $row[] = view('datatable.action', ['module' => "cancer_type",'id' => $cancerTypeData->id])->render();
            $appData[] = $row;
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $cancerTypeCount,
            'recordsFiltered' => $cancerTypeCount,
            'data' => $appData,
        ];
    }

    /**
     * @return mixed
     * @author Nikhil.Jain
     */
    public function create() {
        $data['masterManagementTab'] = "active open";
        $data['cancerTypeTab'] = "active";
        $data['cancerTypeData'] = $this->cancerType->getCollection();
        return $data;
    }

    /**
     * Display the specified cancerType.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function edit($id)
    {
        $data['details'] = $this->cancerType->getCancerTypeByField($id, 'id');
        $data['cancerTypeTab'] = "active";
        return $data;
    }
    
    /**
     * Store and Update cancerType in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function insertAndUpdateCancerType($requestData) {
        return $this->cancerType->addCancerType($requestData);
    }


    /**
     * @param $id
     * @return bool
     * @author Nikhil.Jain
     */
    public function deleteCancerType($id) {
        return $this->cancerType->deleteCancerType($id);
    }
}
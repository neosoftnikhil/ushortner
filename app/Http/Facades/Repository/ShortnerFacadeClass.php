<?php namespace App\Http\Facades\Repository;

use App\Models\UserPlan;
use App\Repositories\Contract\ShortnerInterface;

/**
 * Class ShortnerFacadeClass
 *
 */
class ShortnerFacadeClass
{

    protected $shortner;
    /**
     * Shortner constructor.
     *
     * @param ShortnerInterface $blockedAdjRepo
     */
    public function __construct(ShortnerInterface $repo)
    {
        $this->shortner = $repo;
    }

    /**
     * @return mixed
     * @author Nikhil.Jain
     */
    public function view() {
        $data['shortnerData'] = $this->shortner->getCollection();
        $data['masterManagementTab'] = "active open";
        $data['shortnerTab'] = "active";
        $data['currentPlan'] = UserPlan::getCurrentPlan();
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

        // get the fields for shortner list
        $shortnerData = $this->shortner->getDatatableCollection();

        // get the filtered data of shortner list
        $shortnerFilteredData = $this->shortner->getFilteredData($shortnerData,$request);

        //  Sorting shortner data base on requested sort order
        $shortnerCount = $this->shortner->getCount($shortnerFilteredData);

        // Sorting shortner data base on requested sort order
        $shortnerSortData = $this->shortner->getSortData($shortnerFilteredData,$request);
        
        // get collection of shortner
        $shortnerData = $this->shortner->getData($shortnerSortData,$request);

        $appData = array();
        foreach ($shortnerData as $shortnerData) {
            $row = array();
            $row[] = $shortnerData->url;
            $row[] = '<a href="'.$shortnerData->short_url.'" target="_blank">'.$shortnerData->short_url.'</a>';
            $row[] = view('datatable.switch', ['module' => "shortner",'id' => $shortnerData->id, 'status' => $shortnerData->status])->render();
            $row[] = view('datatable.action', ['module' => "shortner",'id' => $shortnerData->id])->render();
            $appData[] = $row;
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $shortnerCount,
            'recordsFiltered' => $shortnerCount,
            'data' => $appData,
        ];
    }

    /**
     * @return mixed
     * @author Nikhil.Jain
     */
    public function create() {
        $data['masterManagementTab'] = "active open";
        $data['shortnerTab'] = "active";
        $data['shortnerData'] = $this->shortner->getCollection();
        $data['currentPlan'] = UserPlan::getCurrentPlan();
        return $data;
    }

    /**
     * Display the specified shortner.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function edit($id)
    {
        $data['details'] = $this->shortner->getShortnerByField($id, 'id');
        $data['shortnerTab'] = "active";
        $data['currentPlan'] = UserPlan::getCurrentPlan();
        return $data;
    }
    
    /**
     * Store and Update shortner in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function insertAndUpdateShortner($requestData) {
        $requestData['short_url'] = $this->generateShortUrl();
        return $this->shortner->addShortner($requestData);
    }

    /**
     * generate unique short url
     *
     * @return void
     */
    public function generateShortUrl() {
        $token = substr(md5(uniqid(rand(), true)),0,8);
        $shortUrl = url('/').'/'.$token;
        $shotCount = $this->shortner->getCountByShortUrl($shortUrl);
        if($shotCount > 0) {
            $this->generateShortUrl();            
        }
        return $shortUrl;        
    }


    /**
     * @param $id
     * @return bool
     * @author Nikhil.Jain
     */
    public function deleteShortner($id) {
        return $this->shortner->deleteShortner($id);
    }

    /**
     * @param $requestData
     * @return bool
     * @author Nikhil.Jain
     */
    public function updateStatus($requestData) {
        return $this->shortner->updateStatus($requestData);
    }
}
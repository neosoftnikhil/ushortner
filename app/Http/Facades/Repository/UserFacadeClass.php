<?php

namespace App\Http\Facades\Repository;

use App\Repositories\Contract\CancerTypeInterface;
use App\Repositories\Contract\UserInterface;

/**
 * Class UserFacadeClass
 *
 */
class UserFacadeClass
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $user, $cancerTypeRepo;

    /**
     * User constructor.
     *
     * @param UserInterface $blockedAdjRepo
     */
    public function __construct(UserInterface $repo, CancerTypeInterface $cancerTypeInterface)
    {
        $this->user = $repo;
        $this->cancerTypeRepo = $cancerTypeInterface;
    }

    /**
     * @return mixed
     * @author Nikhil.Jain
     */
    public function view() {
        $data['userData'] = $this->user->getCollection();
        $data['cancerTypeData'] = $this->cancerTypeRepo->getCollection();
        $data['userTab'] = "active";
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

        // get the fields for user list
        $userData = $this->user->getDatatableCollection();

        // get the filtered data of user list
        $userFilteredData = $this->user->getFilteredData($userData,$request);

        //  Sorting user data base on requested sort order
        $userCount = $this->user->getCount($userFilteredData);

        // Sorting user data base on requested sort order
        $userSortData = $this->user->getSortData($userFilteredData,$request);
        

        // get collection of user
        $userData = $this->user->getData($userSortData,$request);

        $appData = array();
        foreach ($userData as $userData) {
            $row = array();
            $row[] = $userData->name;
            $row[] = $userData->email;
            $row[] = ($userData->Specialization) ? $userData->Specialization->type : "---";
            $row[] = view('datatable.action', ['module' => "doctor", 'id' => $userData->id])->render();
            $appData[] = $row;
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $userCount,
            'recordsFiltered' => $userCount,
            'data' => $appData,
        ];
    }

    /**
     * @return mixed
     * @author Nikhil.Jain
     */
    public function create() {
        $data['userTab'] = "active";
        $data['userData'] = $this->user->getCollection();
        $data['cancerTypeData'] = $this->cancerTypeRepo->getCollection();
        return $data;
    }

    /**
     * Display the specified user.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function edit($id)
    {
        $data['details'] = $this->user->getUserByField($id, 'id');
        $data['cancerTypeData'] = $this->cancerTypeRepo->getCollection();
        $data['userTab'] = "active";
        return $data;
    }

    /**
     * Store and Update user in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Nikhil.Jain
     */
    public function insertAndUpdateUser($requestData) {
        return $this->user->addUser($requestData);
    }

    /**
     * @param $id
     * @return bool
     * @author Nikhil.Jain
     */
    public function deleteUser($id) {
        return $this->user->deleteUser($id);
    }
}
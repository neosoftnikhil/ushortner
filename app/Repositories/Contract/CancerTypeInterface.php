<?php namespace App\Repositories\Contract;

/**
 * Interface CancerTypeInterface
 * @package App\Repositories\Contract
 */
interface CancerTypeInterface
{
    /**
     *  Get the fields for cancerType list
     *
     * @return mixed
     */
    public function getCollection();

    /**
     *  Get the fields for cancerType list
     *
     * @return mixed
     */
    public function getDatatableCollection();

    /**
     * get CancerType By fieldname getCancerTypeByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getCancerTypeByField($id, $field_name);

    /**
     * Add & update CancerType addCancerType
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addCancerType($models);
    
    /**
     * Delete CancerType
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteCancerType($id);
}

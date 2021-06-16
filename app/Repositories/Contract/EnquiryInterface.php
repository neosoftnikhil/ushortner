<?php namespace App\Repositories\Contract;

/**
 * Interface EnquiryInterface
 * @package App\Repositories\Contract
 */
interface EnquiryInterface
{
    /**
     *  Get the fields for enquiry list
     *
     * @return mixed
     */
    public function getCollection();

    /**
     *  Get the fields for enquiry list
     *
     * @return mixed
     */
    public function getDatatableCollection();

    /**
     * get Enquiry By fieldname getEnquiryByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getEnquiryByField($id, $field_name);

    /**
     * Add & update Enquiry addEnquiry
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addEnquiry($models);
    
    /**
     * Delete Enquiry
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteEnquiry($id);
}

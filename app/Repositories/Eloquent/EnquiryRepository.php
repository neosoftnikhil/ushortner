<?php namespace App\Repositories\Eloquent;

use App\Repositories\Contract\EnquiryInterface;
use App\Models\Enquiry;
use App\Traits\CommonModelTrait;
use Auth;

/**
 * Class EnquiryRepository
 *
 * @package App\Repositories\Eloquent
 */
class EnquiryRepository implements EnquiryInterface
{

    use CommonModelTrait;
    /**
     * Get all Enquiry getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return Enquiry::get();
    }

    /**
     * Get all Enquiry
     *
     * @return mixed
     */
    public function getDatatableCollection()
    {
        if (Auth::user()->role == "admin") {
            return Enquiry::with('Specialization');
        }
        return Enquiry::where('cancer_type_id',Auth::user()->specialization)->with('Specialization','Plan');
        
    }

    /**
     * use for sorting
     *
     * @return array
     */
    public function getSortFields($index)
    {
        $sortableFields = [
            "full_name",
            "email",
            "state",
            "city",
            "cancer_type_id",
            ""
        ];

        return $sortableFields[ $index ];
    }

    /**
     * get Enquiry By fieldname getEnquiryByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getEnquiryByField($id, $field_name)
    {
        return Enquiry::where($field_name, $id)->first();
    }

    /**
     * Add & update Enquiry addEnquiry
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addEnquiry($models)
    {
        $enquiry = new Enquiry;
        $enquiry->created_at = date('Y-m-d H:i:s');
        $enquiry->full_name = $models['full_name'];
        $enquiry->email = $models['email'];
        $enquiry->password = $models['password'];
        $enquiry->contact_number = $models['contact_number'];
        $enquiry->state = $models['state'];
        $enquiry->city = $models['city'];
        $enquiry->address = $models['address'];
        $enquiry->pincode = $models['pincode'];
        $enquiry->cancer_type_id = $models['cancer_type_id'];
        $enquiry->updated_at = date('Y-m-d H:i:s');
        $enquiryId = $enquiry->save();

        if ($enquiryId) {
            return $enquiry;
        } else {
            return false;
        }
    }

    /**
     * Delete Enquiry
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteEnquiry($id)
    {
        $delete = Enquiry::where('id', $id)->delete();
        if ($delete)
            return true;
        else
            return false;

    }
}

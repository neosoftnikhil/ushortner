<?php namespace App\Repositories\Eloquent;

use App\Repositories\Contract\CancerTypeInterface;
use App\Models\CancerType;
use App\Traits\CommonModelTrait;


/**
 * Class CancerTypeRepository
 *
 * @package App\Repositories\Eloquent
 */
class CancerTypeRepository implements CancerTypeInterface
{

    use CommonModelTrait;
    /**
     * Get all CancerType getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return CancerType::get();
    }

    /**
     * Get all CancerType
     *
     * @return mixed
     */
    public function getDatatableCollection()
    {
        return CancerType::with([]);
    }

    /**
     * use for sorting
     *
     * @return array
     */
    public function getSortFields($index)
    {
        $sortableFields = [
            "type",
            ""
        ];

        return $sortableFields[ $index ];
    }

    /**
     * get CancerType By fieldname getCancerTypeByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getCancerTypeByField($id, $field_name)
    {
        return CancerType::where($field_name, $id)->first();
    }

    /**
     * Add & update CancerType addCancerType
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addCancerType($models)
    {
        if (isset($models['id'])) {
            $cancerType = CancerType::find($models['id']);
        } else {
            $cancerType = new CancerType;
            $cancerType->created_at = date('Y-m-d H:i:s');            
        }
        
        $cancerType->type = $models['type'];
        $cancerType->updated_at = date('Y-m-d H:i:s');
        $cancerTypeId = $cancerType->save();

        if ($cancerTypeId) {
            return $cancerType;
        } else {
            return false;
        }
    }

    /**
     * Delete CancerType
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteCancerType($id)
    {
        $delete = CancerType::where('id', $id)->delete();
        if ($delete)
            return true;
        else
            return false;

    }
}

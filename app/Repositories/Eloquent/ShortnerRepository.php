<?php namespace App\Repositories\Eloquent;

use App\Repositories\Contract\ShortnerInterface;
use App\Models\Shortner;
use App\Traits\CommonModelTrait;
use Auth;

/**
 * Class ShortnerRepository
 *
 * @package App\Repositories\Eloquent
 */
class ShortnerRepository implements ShortnerInterface
{

    use CommonModelTrait;
    /**
     * Get all Shortner getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return Shortner::get();
    }

    /**
     * Get all Shortner
     *
     * @return mixed
     */
    public function getDatatableCollection()
    {
        return Shortner::with([]);
    }

    /**
     * use for sorting
     *
     * @return array
     */
    public function getSortFields($index)
    {
        $sortableFields = [
            "url",
            "short_url",
            ""
        ];

        return $sortableFields[ $index ];
    }

    /**
     * get Shortner By fieldname getShortnerByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getShortnerByField($id, $field_name)
    {
        return Shortner::where($field_name, $id)->first();
    }

    /**
     * Add & update Shortner addShortner
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addShortner($models)
    {
        if (isset($models['id'])) {
            $shortner = Shortner::find($models['id']);
        } else {
            $shortner = new Shortner;
            $shortner->created_at = date('Y-m-d H:i:s');
            $shortner->short_url = $models['short_url'];                    
        }

        if(isset($models['status'])) {
            $shortner->status = $models['status'];
        }
        
        $shortner->url = $models['url'];
        $shortner->user_id = Auth::user()->id;
        $shortner->updated_at = date('Y-m-d H:i:s');
        $shortnerId = $shortner->save();

        if ($shortnerId) {
            return $shortner;
        } else {
            return false;
        }
    }

    /**
     * Delete Shortner
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteShortner($id)
    {
        $delete = Shortner::where('id', $id)->delete();
        if ($delete)
            return true;
        else
            return false;

    }

    /**
     * get count by short url
     *
     * @param string $shortUrl
     * @return void
     */
    public function getCountByShortUrl($shortUrl)
    {
        return Shortner::where('short_url', $shortUrl)->count();
    }

    /**
     * update User Status
     *
     * @param array $models
     * @return boolean true | false
     */
    public function updateStatus($models)
    {
        $user = Shortner::find($models['id']);
        $user->status = $models['status'];
        $user->updated_at = date('Y-m-d H:i:s');
        $userId = $user->save();
        if ($userId)
            return true;
        else
            return false;

    }
}

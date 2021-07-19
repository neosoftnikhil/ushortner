<?php namespace App\Repositories\Contract;

/**
 * Interface ShortnerInterface
 * @package App\Repositories\Contract
 */
interface ShortnerInterface
{
    /**
     *  Get the fields for shortner list
     *
     * @return mixed
     */
    public function getCollection();

    /**
     *  Get the fields for shortner list
     *
     * @return mixed
     */
    public function getDatatableCollection();

    /**
     * get Shortner By fieldname getShortnerByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getShortnerByField($id, $field_name);

    /**
     * Add & update Shortner addShortner
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addShortner($models);
    
    /**
     * Delete Shortner
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteShortner($id);

    /**
     * get count by short url
     *
     * @param string $shortUrl
     * @return void
     */
    public function getCountByShortUrl($shortUrl);

    /**
     * update User Status
     *
     * @param array $models
     * @return boolean true | false
     */
    public function updateStatus($models);
}

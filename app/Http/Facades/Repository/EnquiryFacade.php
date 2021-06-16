<?php namespace App\Http\Facades\Repository;

use Illuminate\Support\Facades\Facade;

/**
 * Class Enquiry
 *
 * @package App\Http\Facades\Repository
 */
class EnquiryFacade extends Facade
{

    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'enquiry';
    }
}
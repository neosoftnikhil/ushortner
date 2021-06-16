<?php namespace App\Http\Facades\Repository;

use Illuminate\Support\Facades\Facade;

/**
 * Class CancerTypeFacade
 *
 * @package App\Http\Facades\Repository
 */
class CancerTypeFacade extends Facade
{

    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'cancer_type';
    }
}
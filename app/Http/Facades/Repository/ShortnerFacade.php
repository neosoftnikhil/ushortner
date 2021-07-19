<?php namespace App\Http\Facades\Repository;

use Illuminate\Support\Facades\Facade;

/**
 * Class ShortnerFacade
 *
 * @package App\Http\Facades\Repository
 */
class ShortnerFacade extends Facade
{

    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'shortner';
    }
}
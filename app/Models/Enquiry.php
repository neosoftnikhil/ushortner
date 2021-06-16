<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiry';
    protected $primaryKey = 'id';

    /**
     * get specialization from cancer type model 
     *
     * @return void
     */
    public function Specialization()
    {
        return $this->hasOne('App\Models\CancerType', 'id', 'cancer_type_id');
    }

    /**
     * get specialization from cancer type model 
     *
     * @return void
     */
    public function Plan()
    {
        return $this->hasOne('App\Models\Plan', 'enquiry_id', 'id');
    }
}

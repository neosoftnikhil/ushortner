<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancerType extends Model
{
    use SoftDeletes;
    protected $table = 'cancer_types';
    protected $primaryKey = 'id';

}

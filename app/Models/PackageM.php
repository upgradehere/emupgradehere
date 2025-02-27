<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;



class PackageM extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'package_m';
}

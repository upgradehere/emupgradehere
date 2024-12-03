<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class PackageM extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'package_m';
}

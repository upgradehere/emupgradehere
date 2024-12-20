<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyM;
use Carbon\Carbon;

class DepartementM extends Model
{
    use HasFactory;

    protected $table = 'departement_m';
    protected $primaryKey = 'departement_id';

    public function company()
    {
        return $this->hasOne(CompanyM::class, 'company_id', 'company_id');
    }
}

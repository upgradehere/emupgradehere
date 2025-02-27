<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CompanyM;
use Carbon\Carbon;

class DepartementM extends BaseModel
{
    use HasFactory;

    protected $table = 'departement_m';
    protected $primaryKey = 'departement_id';

    public function company()
    {
        return $this->hasOne(CompanyM::class, 'company_id', 'company_id');
    }
}

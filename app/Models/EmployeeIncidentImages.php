<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeIncidentImages extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function incident()
    {
        return $this->belongsTo(EmployeeIncident::class, 'emp_incident_id');
    }
}

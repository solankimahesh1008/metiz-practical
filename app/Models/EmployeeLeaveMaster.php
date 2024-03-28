<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'leaveType',
        'employee_code',
        'fromdate',
        'todate',
        'numberofDays',
        'comment',
    ];
}

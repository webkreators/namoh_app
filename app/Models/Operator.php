<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name', 'operator_name', 'contact_number', 'secondary_number', 'address', 'dob', 'aadhaar_number', 'licence',
        'agreement', 'gstin_number'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'product_id';
    
    protected $fillable = array(
        'product_name', 'product_plan', 'product_charge', 'description'
    );

    static $plans = array(
        '1' => 'Monthly',
        '3' => 'Quarterly',
        '4' => 'Half Yearly',
        '2' => 'Yearly',
        '5' => '2 Years'
    );
}

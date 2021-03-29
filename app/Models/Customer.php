<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customer';
    protected $primaryKey = "client_id";
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name_title',
        'customer_name',
        'customer_address',
        'customer_contact_number',
        'contact_number_two',
        'customer_email',
        'customer_email_address',
        'gstin_no',
        'pan_no',
        'aadhar_no',
        'dob',
        'anniversary_date',
        'connection_date',
        'remarks',
        'status',
        'static_ip',
        'created_at',
        'updated_at'
    ];
}

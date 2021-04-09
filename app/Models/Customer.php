<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\Models\Invoice;

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

    public static function checkNotifications() {
        $date = Carbon::now()->format('Y-m-d');
        $notifications = array();
        $birthday_today_customers = self::where('dob', $date)->get();
        foreach ($birthday_today_customers as $customer) {
            $notifications[] = array('type' => 'birthday', 'message' => "{$customer->customer_name} is having birthday", 'when' => 'Today');
        }
        $anniversary_today_customers = self::where('anniversary_date', $date)->get();
        foreach ($anniversary_today_customers as $customer) {
            $notifications[] = array('type' => 'anniversary', 'message' => "{$customer->customer_name} is having anniversary", 'when' => 'Today');
        }
        $date = Carbon::now()->addDays(1)->format('Y-m-d');
        $connection_expiring_customers = Invoice::where('end_date', $date)->join('customer', 'customer.client_id', '=', 'invoice.client_id')->get();
        foreach ($connection_expiring_customers as $customer) {
            $notifications[] = array('type' => 'anniversary', 'message' => "{$customer->customer_name}'s connection is expiring", 'when' => 'Tomorrow');
        }
        return $notifications;
    }
}

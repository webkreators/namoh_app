<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceDetail;
use App\Models\Customer;

class Invoice extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'invoice_id';
    protected $table = 'invoice';
    
    protected $fillable = array(
        'client_id',
        'total_amount',
        'remarks',
        'CGST',
        'SGST',
        'tax_slab',
        'tax_per',
        'invoice_date',
        'connection_date',
        'invoice_no',
        'grand_total',
        'discount_in',
        'discount',
        'service_time',
        'router_free',
        'start_date',
        'end_date',
        'bank_id',
        'paid_unpaid',
        'financial_year',
        'invoice_type',
        'bill_type',
        'payment_comment'
    );
    
    public function items() {
        return $this->hasMany(InvoiceDetail::class, 'insert_id', 'invoice_id');
    }
    
    public function customer() {
        return $this->belongsTo(Customer::class, 'client_id', 'client_id');
    }
    
    public static function numberTowords($num) {
        $ones = array(
            0 =>"ZERO",
            1 => "ONE",
            2 => "TWO",
            3 => "THREE",
            4 => "FOUR",
            5 => "FIVE",
            6 => "SIX",
            7 => "SEVEN",
            8 => "EIGHT",
            9 => "NINE",
            10 => "TEN",
            11 => "ELEVEN",
            12 => "TWELVE",
            13 => "THIRTEEN",
            14 => "FOURTEEN",
            15 => "FIFTEEN",
            16 => "SIXTEEN",
            17 => "SEVENTEEN",
            18 => "EIGHTEEN",
            19 => "NINETEEN",
            "014" => "FOURTEEN"
        );
        $tens = array( 
            0 => "ZERO",
            1 => "TEN",
            2 => "TWENTY",
            3 => "THIRTY", 
            4 => "FORTY", 
            5 => "FIFTY", 
            6 => "SIXTY", 
            7 => "SEVENTY", 
            8 => "EIGHTY", 
            9 => "NINETY" 
        ); 
        $hundreds = array( 
            "HUNDRED", 
            "THOUSAND", 
            "MILLION", 
            "BILLION", 
            "TRILLION", 
            "QUARDRILLION" 
        ); /*limit t quadrillion */
        $num = number_format($num,2,".",","); 
        $num_arr = explode(".",$num); 
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
        $whole_arr = array_reverse(explode(",",$wholenum)); 
        krsort($whole_arr,1); 
        $rettxt = ""; 
        foreach ($whole_arr as $key => $i) {
            
            while (substr($i,0,1) == "0")
            $i = substr($i,1,5);
            if ($i < 20) { 
                /* echo "getting:".$i; */
                $rettxt .= $ones[$i]; 
            } else if ($i < 100){ 
                if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
                if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
            } else { 
                if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
                if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
            } 
            if($key > 0){ 
                $rettxt .= " ".$hundreds[$key]." "; 
            }
        } 
        if ($decnum > 0) {
            $rettxt .= " and ";
            if ($decnum < 20){
                $rettxt .= $ones[$decnum];
            } else if($decnum < 100){
                $rettxt .= $tens[substr($decnum,0,1)];
                $rettxt .= " ".$ones[substr($decnum,1,1)];
            }
        }
        return $rettxt;
    }
}

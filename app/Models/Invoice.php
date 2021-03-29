<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceItem;

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
        return $this->hasMany(InvoiceItem::class);
    }
}

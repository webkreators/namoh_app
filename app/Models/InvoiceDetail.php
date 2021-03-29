<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = array(
        'invoice_no', 'insert_id', 'goods_id', 'goods_amount', 'invoice_date'
    );
}

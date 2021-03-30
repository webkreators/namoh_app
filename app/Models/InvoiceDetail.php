<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = array(
        'invoice_no', 'insert_id', 'goods_id', 'goods_amount', 'invoice_date'
    );

    public function item() {
        return $this->hasOne(Service::class, 'product_id', 'goods_id');
    }

}

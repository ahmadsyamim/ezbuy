<?php

namespace Modules\Ezbuy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'status',
        'producturl',
        'selection',
        'variableone',
        'variabletwo',
        'billid',
        'paymentlink',
        'paidtime',
        'takeprice',
        'sellprice',
        'categorylink',
        'shippingaddress',
        'billingaddress',
        'tracking',
        'comment',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Ezbuy\Database\factories\ProductFactory::new();
    }
}

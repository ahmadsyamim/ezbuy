<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyforme extends Model
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
}

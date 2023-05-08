<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table='orders';
    public function payment(){
        return $this->hasOne(Payments::class,'transaction_id','transaction_id');
    }
    use HasFactory;
}

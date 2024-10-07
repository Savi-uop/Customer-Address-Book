<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', 'address_number', 'address_street', 'address_city'
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}

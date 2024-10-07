<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'company', 'contact_phone', 'email', 'country','address_number', 'address_street', 'address_city'
    ];

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // Customer belongs to many projects
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    
}

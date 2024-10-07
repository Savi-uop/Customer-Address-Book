<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',         // Add this line
        'description',  // Add this line as well
    ];
    
    // public function customers()
    // {
    //     return $this->belongsToMany(Customer::class);
    // }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_project'); // Specify the pivot table name if it's different
    }
}

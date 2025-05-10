<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Haircut extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'style',
        'groomer_name',
        'price',
        'notes',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ]; 
    
    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship to Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}

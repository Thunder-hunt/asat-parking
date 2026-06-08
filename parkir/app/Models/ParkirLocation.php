<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirLocation extends Model
{
    use HasFactory;

    protected $table = 'parkir_locations';

    protected $fillable = [
        'location_name',
        'max_motorcycle',
        'max_car',
        'max_other',
        'available_motorcycle',
        'available_car',
        'available_other'
    ];

    /**
     * Relationship with Transactions
     */
    public function transactions()
    {
        return $this->hasMany(ParkirTransaction::class, 'id_lokasi');
    }
}

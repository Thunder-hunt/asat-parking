<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirTransaction extends Model
{
    use HasFactory;

    protected $table = 'parkir_transactions';

    protected $fillable = [
        'id_lokasi',
        'no_tiket',
        'no_polisi',
        'id_jenis',
        'masuk',
        'keluar',
        'perjam_pertama',
        'perjam_berikutnya',
        'max_perhari',
        'total_jam',
        'total_bayar'
    ];

    protected $casts = [
        'masuk' => 'datetime',
        'keluar' => 'datetime',
    ];

    /**
     * Relationship with Location
     */
    public function location()
    {
        return $this->belongsTo(ParkirLocation::class, 'id_lokasi');
    }

    /**
     * Relationship with Vehicle Type
     */
    public function vehicleType()
    {
        return $this->belongsTo(ParkirVehicleType::class, 'id_jenis');
    }
}

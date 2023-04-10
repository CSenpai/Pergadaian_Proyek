<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegadaian_id',
        'type',
        'location',
    ];

    public function pegadaian()
    {
        return $this->belongsTo(Pegadaian::class);
    }
}
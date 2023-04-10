<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegadaian extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',  
        'age',
        'phone',
        'nik',
        'item',
        'foto',
    ];
    public function response()
    {
        return $this->hasOne(Response::class);
    }
}
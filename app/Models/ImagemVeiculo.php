<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagemVeiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'veiculo_id',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'marca_id',
    ];
    
    // Defina as relações com as outras tabelas, se necessário
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}

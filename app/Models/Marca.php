<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
    ];

    // Define as relações com as outras tabelas
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}

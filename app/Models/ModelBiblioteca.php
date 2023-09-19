<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBiblioteca extends Model
{
    use HasFactory;

   protected $fillable = [
        'nomeLivro',
        'Autor',
        'Genero'
    ];
}

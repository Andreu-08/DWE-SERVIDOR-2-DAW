<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Noticia extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'cuerpo', 'enlace'];

    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class);
    }
    
    public function votos()
    {
        return $this -> hasMany(Voto::class);
    }

    public function comentarios()
    {
        return $this -> hasMany(Comentario::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Fichero;

class Comment extends Model
{
    // protected $fillable = ['content', 'user_id', 'file_id'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    // Relación con el fichero
    public function file()
    {
        return $this->belongsTo(Fichero::class, 'file_id');
    }

    //Relacion para responder comentarios de forma recursiva
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}

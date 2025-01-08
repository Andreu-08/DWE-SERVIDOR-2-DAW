<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Fichero extends Model
{
    use SoftDeletes;

    protected $table = 'ficheroes'; // Especificar el nombre de la tabla

    // protected $fillable = [
    //     'user_id',
    //     'name',
    //     'path',
    //     'visibility',
    // ];

    protected $dates = ['deleted_at'];

    // Relación many-to-one con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación many-to-many con el modelo User para archivos compartidos
    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'fichero_user', 'fichero_id', 'user_id');
    }

    // Método para calcular el tamaño del archivo
    public function size()
    {
        return Storage::disk('private')->size($this->path);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'file_id'); 
    }
}

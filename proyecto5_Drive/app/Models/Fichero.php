<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Fichero extends Model
{

    
    public function size()
    {
        return Storage::disk('private')->size($this->path);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function comments()
    {
        return $this->hasMany(Comment::class, 'file_id');   
    }
    
}

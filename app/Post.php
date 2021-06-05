<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function penciler(){
        return $this->belongsTo(Penciler::class);
    }

    public function character(){
        return $this->belongsToMany(Character::class);
    }
}

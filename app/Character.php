<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public function show_characters(){
        return Character::all();
    }

    public function post(){
        return $this->belongsToMany(Post::class);
    }
}

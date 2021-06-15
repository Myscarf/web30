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

    public function get_best_post(){

        return Post::orderBy('view', 'DESC')->limit(3)->get();
    }

    public function get_random_post(){
        return Post::inRandomOrder()->limit(1)->get();
    }
}

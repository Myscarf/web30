<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    public function show_social(){
        return Social::all();
    }
}

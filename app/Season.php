<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public $fillable = ['year'];
    public function rounds()
    {
        return $this->hasMany(Round::class);
    }
}

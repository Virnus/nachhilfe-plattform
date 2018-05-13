<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function angebote()
    {
        return $this->hasMany(Angebot::class);
    }
}

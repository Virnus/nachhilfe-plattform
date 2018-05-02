<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anmeldung extends Model
{
    protected $fillable = ['user_id', 'lernzentrum_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lernzentrum()
    {
        return $this->belongsTo(Lernzentrum::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function scopeByLernzentrum($builder, $lernzentrum)
    {
        return $builder->where('lernzentrum_id', $lernzentrum->id);
    }
}

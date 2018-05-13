<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Topic extends Model
{
    protected $fillable = ['name', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function angebote()
    {
        return $this->belongsToMany(Angebot::class);
    }

    public function anmeldungen()
    {
        return $this->belongsToMany(Anmeldung::class);
    }

    public function scopeByName(Builder $builder, $request)
    {
        return $builder->where('name', 'like', $request->name . '%');
    }

    public function scopeBySubject(Builder $builder, $request)
    {
        return $builder->where('subject_id', $request->subject);
    }
}

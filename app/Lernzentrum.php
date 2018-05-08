<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lernzentrum extends Model
{
    protected $fillable = ['date', 'info', 'room', 'teacher_id', 'max_participants'];

    protected $dates = ['date'];

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function anmeldungen()
    {
        return $this->hasMany(Anmeldung::class);
    }

    public function assistants()
    {
        return $this->belongsToMany(User::class, 'assistant_lernzentrum', 'lernzentrum_id', 'assistant_id');
    }

    public function scopeFilter(Builder $builder)
    {
        return $builder;
    }

    public function scopeIsFuture($builder)
    {
        return $builder->where('date', '>=', Carbon::now());
    }

    public function isSignUp(User $user)
    {
        $anmeldung = $user->anmeldungen()->where('lernzentrum_id', $this->id)->first();

        return $this->anmeldungen->contains($anmeldung);
    }
}

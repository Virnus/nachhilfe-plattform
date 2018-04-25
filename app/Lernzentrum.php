<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lernzentrum extends Model
{
    protected $fillable = [];

    protected $dates = ['date'];

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function assistants()
    {
        return $this->belongsToMany(User::class, 'assistant_lernzentrum', 'lernzentrum_id', 'assistant_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeIsFuture($builder)
    {
        return $builder->where('date', '>=', Carbon::now());
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Angebot extends Model
{
    protected $fillable = ['info', 'provider_id', 'subject_id', 'topic_id'];

    public function provider()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'angebot_topic');
    }

    public function scopeFilter(Builder $builder, $query)
    {
        return $builder->where('info', 'LIKE', '%' . $query . '%');
    }


}

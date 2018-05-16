<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Angebot extends Model
{
    protected $fillable = [ 'title', 'info', 'user_id', 'subject_id'];

    public function user()
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

    public function scopeById(Builder $builder, $id)
    {
        return $builder->where('id', $id);
    }

    public function scopeFilter(Builder $builder, $query)
    {
        return $builder->where('title', 'LIKE', '%' . $query . '%');
    }

    public function scopeBySubject(Builder $builder, $subjectId)
    {
        return $builder->where('subject_id', $subjectId);
    }

    public function scopeByTopic(Builder $builder, $topicId)
    {
        if (empty($topicId)) {
            return $builder;
        }

        return $builder->whereHas('topics', function ($query) use ($topicId) {
            $query->where('id', $topicId);
        });
    }


}

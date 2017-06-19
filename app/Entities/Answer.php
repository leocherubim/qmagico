<?php

namespace QMagico\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id', 'question_id', 'parent_id',
    ];

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function parent()
    {
    	return $this->belongsTo(Answer::class);
    }

    public function children()
    {
    	return $this->hasMany(Answer::class, 'parent_id');
    }
}

<?php

namespace QMagico\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'forum_id', 'user_id',
    ];

    public function forum()
    {
    	return $this->belongsTo(Forum::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

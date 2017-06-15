<?php

namespace QMagico\Entities;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'user_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
}

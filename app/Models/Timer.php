<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'project_id',
        'stopped_at',
        'started_at'
    ];

    protected $dates = ['started_at', 'stopped_at'];

    protected $with = ['user'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Project::class, 'project_id','id');
    }

    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->id());
    }

    public function scopeRunning($query)
    {
        return $query->whereNull('stopped_at');
    }
}

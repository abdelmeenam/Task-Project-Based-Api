<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ["title"];


    protected static function booted()
    {
        //Global Filter to get only Projects of the auth user
        // we will filter using Polices instead

        //static::addGlobalScope('creator', function (Builder $builder) {
        //    $builder->where('creator_id', Auth::id());
        //});

        static::addGlobalScope('member', function (Builder $builder) {
            $builder->whereRelation('members', 'user_id', Auth::id());
        });
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, Member::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $casts = [
        'is_done' => 'boolean'
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected  $fillable = [
        'title', 'is_done', 'project_id'
    ];


    protected static function booted()
    {
        static::addGlobalScope('member', function (Builder $builder) {
            DB::enableQueryLog();
            $builder
                //->where('creator_id', Auth::id())
                ->orWhereIn('project_id', Auth::user()->memberships->pluck('id')->all());
            dd(DB::getQueryLog());
        });
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
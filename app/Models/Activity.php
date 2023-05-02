<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['type', 'user'];

    public function type()
    {
        return $this->belongsTo(ActivityType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
    public function getRouteKeyName(): string
    {
        return 'username';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['position', 'department'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function supervisor(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

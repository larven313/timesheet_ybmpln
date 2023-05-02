<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['activity'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

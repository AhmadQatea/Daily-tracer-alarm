<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    use HasFactory;

    protected $fillable = [
        'bedtime',
        'wake_up_time',
        'today_date',
        'user_id',
    ];

    public $timestamps = false; // تعطيل استخدام الأعمدة created_at و updated_at
}

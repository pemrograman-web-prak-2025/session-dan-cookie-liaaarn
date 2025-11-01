<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddSchedule extends Model
{
    use HasFactory;

    protected $table = 'addschedule';
    protected $fillable = [
        'user_id',
        'date',
        'time',
        'title',
        'description'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'working_hours',
        'location',
        'date',  // Menambahkan field 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

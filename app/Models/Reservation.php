<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'room_id'
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;
use App\Models\chambre;
use App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

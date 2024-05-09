<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomOptions extends Model
{
    use HasFactory;
    protected $fillable = ['icon', 'label'];

    public $timestamps = false;
    public function room()
    {
        return $this->belongsToMany(Room::class, RoomsRoomOptions::class)->withPivot('value');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsRoomOptions extends Model
{
    use HasFactory;
    protected $fillable = ['value'];
    protected $table = "rooms_room_options";
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function roomOptions()
    {
        return $this->belongsTo(RoomOptions::class);
    }
}

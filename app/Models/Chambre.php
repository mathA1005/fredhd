<?php
namespace App\Models;
use App\Models\Equipement;
use App\Models\Reservation;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description', 'photo'];

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function checkAvailability(Request $request, Chambre $chambre)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $existingReservations = $chambre->reservations()
            ->where(function($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date]);
            })->count();

        return $existingReservations === 0
            ? response()->json(['available' => true])
            : response()->json(['available' => false]);
    }
}

<?php
namespace App\Models;
use App\Models\Equipement;

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
}

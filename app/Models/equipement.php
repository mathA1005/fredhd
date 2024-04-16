<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipement extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description'];

    public function chambre()
    {
        return $this->belongsToMany(Chambre::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Reliese\Coders\Model\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    // Constantes des rôles disponibles
    public const ADMIN = 'Administrateur';
    public const USER = 'Utilisateur';
    public $timestamps = false;

    public static function roles(): array
    {
        return [
            self::ADMIN,
            self::USER,
        ];
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

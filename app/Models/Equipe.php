<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipe extends Model
{
    use HasFactory;

    protected $table = 'equipe';

    protected $primaryKey = 'idEquipe';

    public $timestamps = false;

    protected $fillable = [
        'idSport',
        'nom',
        'Division',
    ];

    protected function casts(): array
    {
        return [
            'idEquipe' => 'integer',
            'idSport' => 'integer',
            'Division' => 'integer',
        ];
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class, 'idSport', 'idSports');
    }

    public function joueurs(): HasMany
    {
        return $this->hasMany(Joueur::class, 'idEquipe', 'idEquipe');
    }

    public function matchs(): HasMany
    {
        return $this->hasMany(\App\Models\Match::class, 'idEquipe', 'idEquipe');
    }

    public function entrainements(): HasMany
    {
        return $this->hasMany(Entrainement::class, 'idEquipe', 'idEquipe');
    }
}

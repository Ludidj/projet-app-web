<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Joueur extends Model
{
    protected $table = 'joueurs';

    protected $primaryKey = 'idJoueurs';

    public $timestamps = false;

    protected $fillable = [
        'idEquipe',
        'nom',
        'prénom',
        'numero',
        'division',
        'age',
        'sexe'
    ];

    protected function casts(): array
    {
        return [
            'idEquipe' => 'integer',
            'age' => 'integer',
            'numero' => 'integer'
        ];
    }

    public function equipe(): BelongsTo
    {
        return $this->belongsTo(Equipe::class, 'idEquipe', 'idEquipe');
    }
}

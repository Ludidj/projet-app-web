<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Match1 extends Model
{
    use HasFactory;

    protected $table = 'Match';

    protected $primaryKey = 'idMatch';

    public $timestamps = false;

    protected $fillable = [
        'idMatch',
        'idEquipe',
        'date',
        'Lieu',
        'heure',
        'idAdversaire',
        'scoreEquipe',
        'scoreAdversair'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'heure' => 'string',
            'idEquipe' => 'integer',
            'idAdversaire' => 'integer',
            'scoreEquipe' => 'integer',
            'scoreAdversair' => 'integer'
        ];
    }

    public function equipe(): BelongsTo
    {
        return $this->belongsTo(Equipe::class, 'idEquipe', 'idEquipe');
    }
}

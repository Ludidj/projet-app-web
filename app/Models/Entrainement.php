<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrainement extends Model
{
    use HasFactory;

    protected $table = 'Entrainement';

    protected $primaryKey = 'idEntrainement';

    public $timestamps = false;

    protected $fillable = ['idEntrainement', 'idEquipe', 'heure', 'fréquence'];

    protected function casts(): array
    {
        return [
            'idEntrainement' => 'integer',
            'idEquipe' => 'integer'
        ];
    }

    public function equipe(): BelongsTo
    {
        return $this->belongsTo(Equipe::class, 'idEquipe', 'idEquipe');
    }
}

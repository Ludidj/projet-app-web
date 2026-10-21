<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Joueur extends Model
{
    //
    use HasFactory;

protected $fillable = [ 'idJoueurs', 'idEquipe', 'nom', 'prénom', 'numero', 'division', 'age', 'sexe'];


protected function casts(): array
    {
        return [
                'idJoueurs' => 'integer',
                'idEquipe' => 'integer',
                'age' => 'integer',
                'numero' => 'integer'
                ];
    }



public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);

   }



public function comments(): HasMany

{
        return $this->hasMany(Sport::class);
    }

}

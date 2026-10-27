<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sport extends Model
{
    use HasFactory;

    protected $table = 'sports';

    protected $primaryKey = 'idSports';

    public $timestamps = false;

    protected $fillable = [
       
        'nomSport',
        'description'
    ];

    protected function casts(): array
    {
        return [
            'idSports' => 'integer'
        ];
    }

    public function equipes(): HasMany
    {
        return $this->hasMany(Equipe::class, 'idSport', 'idSports');
    }
}

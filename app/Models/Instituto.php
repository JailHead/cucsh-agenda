<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instituto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instituciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'activo',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    /**
     * Get the eventos for the instituto.
     */
    public function eventos(): HasMany
    {
        return $this->hasMany(Evento::class, 'institucion_id');
    }
}

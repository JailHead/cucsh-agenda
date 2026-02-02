<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventoFecha extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eventos_fechas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'evento_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'hora_inicio' => 'datetime:H:i',
            'hora_fin' => 'datetime:H:i',
        ];
    }

    /**
     * Get the evento that owns the fecha.
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }
}
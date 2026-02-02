<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'tipo_evento_id',
        'dependencia_id',
        'otra_dependencia',
        'organizador_id',
        'notas_cta',
        'notas_servicios_generales',
        'institucion_id',
        'usuario_id',
    ];

    /**
     * Get the tipo evento that owns the evento.
     */
    public function tipoEvento(): BelongsTo
    {
        return $this->belongsTo(TipoEvento::class);
    }

    /**
     * Get the dependencia that owns the evento.
     */
    public function dependencia(): BelongsTo
    {
        return $this->belongsTo(Dependencia::class);
    }

    /**
     * Get the organizador that owns the evento.
     */
    public function organizador(): BelongsTo
    {
        return $this->belongsTo(Organizador::class);
    }

    /**
     * Get the institucion that owns the evento.
     */
    public function institucion(): BelongsTo
    {
        return $this->belongsTo(Instituto::class, 'institucion_id');
    }

    /**
     * Get the user that created the evento.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Get the fechas for the evento.
     */
    public function fechas(): HasMany
    {
        return $this->hasMany(EventoFecha::class);
    }
}

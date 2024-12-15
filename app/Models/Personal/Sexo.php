<?php

namespace App\Models\Personal;

use App\Models\Personal;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = "personal_sexo";

    protected $primaryKey = 'idpersonal_sexo';

    protected $fillable = [
        'sexo',
    ];

    /**
     * Relación de "uno a muchos" (inversa) con la tabla "personal".
     * Un Sexo puede tener varios registros asociados en la tabla "personal".
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personales()
    {
        return $this->hasMany(Personal::class);
    }
}
<?php

namespace App\Models\Personal;

use App\Models\Personal;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "personal_categorias";

    protected $primaryKey = 'idpersonal_categorias';

    protected $fillable = [
        'categoria',
    ];

    /**
     * Relación de "uno a muchos" (inversa) con la tabla "personal".
     * Una categoría puede tener varios registros asociados en la tabla "personal".
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personales()
    {
        return $this->hasMany(Personal::class);
    }
}

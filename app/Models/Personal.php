<?php

namespace App\Models;

use App\Models\Personal\Categoria;
use App\Models\Personal\Estado;
use App\Models\Personal\Sexo;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = "personal";

    protected $primaryKey = 'idpersonal';

    protected $fillable = [
        'nombres',
        'apellidos',
        'nombrecompleto',
        'codigo',
        'categoria_id',
        'compania_id',
        'fecha_juramento',
        'estado_id',
        'documento',
        'sexo_id',
        'nacionalidad_id',
        'contrasena',
    ];

    /**
     * Relación de "uno a muchos" con la tabla "personal_categorias".
     * Cada registro de este modelo pertenece a una categoría específica a través del campo "categoria_id".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Relación de "uno a muchos" con la tabla "personal_estados".
     * Cada registro de este modelo pertenece a una categoría específica a través del campo "estado_id".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    /**
     * Relación de "uno a muchos" con la tabla "personal_sexo".
     * Cada registro de este modelo pertenece a una categoría específica a través del campo "sexo_id".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'sexo_id');
    }

    /**
     * Relación de "uno a muchos" con la tabla "paises".
     * Cada registro de este modelo pertenece a un pais específico a través del campo "nacionalidad_id".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'nacionalidad_id');
    }
}

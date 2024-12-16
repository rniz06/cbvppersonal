<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompaniaVista extends Model
{
    protected $connection = "db_companias";

    protected $table = "vt_companias";

    protected $primaryKey = 'idcompanias';

    public $timestamps = false;

    public static function obtenerListadoCompanias()
    {
        return CompaniaVista::selectRaw('idcompanias AS id, CONCAT(compania, \' - \', departamento, \' - \', ciudad) AS label')
            ->orderBy('orden', 'asc')
            ->get()
            ->pluck('label', 'id');
    }
}

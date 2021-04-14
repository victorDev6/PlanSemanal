<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model {
    
    protected $table = 'actividades';

    protected $fillable = [
        'id', 'fecha', 'asunto', 'area_responsable', 'actividad', 'status', 'observaciones', 'semana', 
        'fecha_enviado', 'tipo_actividad', 'id_organo', 'id_departamento', 'mostrar'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function scopeBusqueda($query, $buscar) {
        // if (!empty($tipo)) {
            if (!empty(trim($buscar))) {
                // switch ($tipo) {
                    // case 'semana':
                        return $query->where('actividades.semana', '=', $buscar);
                        // break;
                // }
            }
        // }
    }

    /* public function scopeValidacion($query, $tipo, $semana) {
        if (!empty($tipo)) {
            if (!empty(trim($semana))) {
                return $query
                    ->where('actividades.id_organo', '=', $tipo)
                    ->where('actividades.semana', '=', $semana);
            }
            else {
                return $query 
                    ->where('actividades.id_organo', '=', $tipo);
            }
        }
    } */
}

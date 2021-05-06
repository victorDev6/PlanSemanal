<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model {
    
    protected $table = 'pagos';

    protected $fillable = [
        'id', 'title', 'start', 'end', 'comentarios', 'textColor', 'id_unidad', 'fecha_enviado', 'modalidad'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}

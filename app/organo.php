<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organo extends Model
{
    protected $table = 'organos';

    protected $fillable = [
        'id', 'id_parent', 'descripcion',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}

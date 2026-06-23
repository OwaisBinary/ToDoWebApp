<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function toDos()
    {
        return $this->hasMany(ToDo::class);
    }

    protected $fillable = [
        'name',
    ];
}

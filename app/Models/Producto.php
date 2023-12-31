<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'precio_estandar', 'precio_minimo', 'imagen', 'stock'];
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

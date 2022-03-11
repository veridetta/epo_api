<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class food extends Model
{
    use HasFactory;
    protected $fillable = [
        'soal',
        'gambar_soal',
        'a',
        'a_gambar',
        'b',
        'b_gambar',
        'c',
        'c_gambar',
        'd',
        'd_gambar',
        'kunci',
        'cat_id'
    ];
    public function cat()
    {
        return $this->hasMany(Cat::class);
    }
    public function food()
    {
        return $this->hasMany(Food::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}

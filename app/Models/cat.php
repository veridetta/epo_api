<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'food_id', 'cat_id', 'cover'
    ];

    public function food()
    {
        return $this->belongsTo(food::class, 'food_id');
    }

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'cat_id');
    }
}

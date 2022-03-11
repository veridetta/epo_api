<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'food_id',
        'comment',
        'rating',
    ];
    public function foods()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

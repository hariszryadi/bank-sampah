<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'photo', 'price'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}

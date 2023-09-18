<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'waste_id', 'qty', 'total'];

    public function waste() {
        return $this->belongsTo(Waste::class, 'waste_id');
    }
}

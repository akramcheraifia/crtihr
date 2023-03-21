<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'corp_id'];
    public function corp()
    {
        return $this->belongsTo(Corp::class);
    }
    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];
    public function corp()
    {
        return $this->hasMany(Corp::class);
    }
    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}

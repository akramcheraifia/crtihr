<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $fillable = ['nom', 'prenom', 'nom_ar', 'prenom_ar', 'NIN','CNAS', 'date_naissance', 'date_recrutement', 'lieu_naissance', 'sexe', 'situation_familiale','type_contrat', 'RIB', 'email', 'phone', 'image', 'filiere_id', 'corp_id', 'grade_id', 'site_id', 'status'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
    public function corp()
    {
        return $this->belongsTo(Corp::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}

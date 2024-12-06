<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paramservice extends Model
{
    use HasFactory;

    public function getNameTypeClient($id)
    {
        return ($id == 1) ? "Personne Physique" : "Personne Morale" ;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'adresse',
        'telephone_1',
        'telephone_2',
        'email',
        'heures_ouverture_1',
        'twitter_url',
        'facebook_url',
        'youtube_url',
        'linkedin_url',
        'logo',
    ];
}
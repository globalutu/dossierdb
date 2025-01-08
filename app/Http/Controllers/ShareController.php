<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function file()
    {

        $users = Utilisateur::all();

        return view('viewadmindste.file', compact('users'));
    }
}

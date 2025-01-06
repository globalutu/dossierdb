<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Content;
use App\Models\Team;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    /**
     * Afficher le tableau de bord.
     */
    public function dashfront()
    {
        $teamMembers = Team::all();
        $users = Utilisateur::all();
        $contact = Contact::first();
        $subscribers = Newsletter::all();
        $services = Service::all();
        $testimonials = Testimonial::all();
        $Contents = Content::first();

        if (!$contact) {
            return redirect()->back()->with('error', 'Aucun contact trouvé.');
        }

        return view('viewadmindste.dashfront', compact('Contents', 'contact', 'subscribers', 'users', 'testimonials', 'services', 'teamMembers'));
    }

    /**
     * Afficher les données du contact pour modification.
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('viewadmindste.dashfront', compact('contact'));
    }

    /**
     * Mettre à jour les données du contact.
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        // Validation des données
        $request->validate([
            'adresse' => 'required|string|max:255',
            'telephone_1' => 'required|string|max:20',
            'telephone_2' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'heures_ouverture_1' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mise à jour des données
        $contact->adresse = $request->adresse;
        $contact->telephone_1 = $request->telephone_1;
        $contact->telephone_2 = $request->telephone_2;
        $contact->email = $request->email;
        $contact->heures_ouverture_1 = $request->heures_ouverture_1;
        $contact->facebook_url = $request->facebook_url;
        $contact->twitter_url = $request->twitter_url;
        $contact->linkedin_url = $request->linkedin_url;

        // Gestion du logo si un fichier a été téléchargé
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo s'il existe
            if ($contact->logo) {
                Storage::disk('public')->delete($contact->logo);
            }

            // Sauvegarder le nouveau logo
            $contact->logo = $request->file('logo')->store('logos', 'public');
        }

        // Sauvegarde des modifications
        $contact->save();

        // Redirection avec un message de succès
        return redirect()->route('sev', $contact->id)->with('success', 'Contact mis à jour avec succès');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nom complet
            'position' => 'required|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour l'image
        ]);

        // Insertion dans la base de données
        $teamMember = new Team();
        $teamMember->name = $validated['name'];
        $teamMember->position = $validated['position'];
        $teamMember->facebook_url = $validated['facebook_url'];
        $teamMember->twitter_url = $validated['twitter_url'];
        $teamMember->linkedin_url = $validated['linkedin_url'];

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = public_path('storage/teams');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $imageName = str_replace(' ', '_', strtolower($validated['name'])) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $teamMember->image = 'teams/' . $imageName;
        }

        $teamMember->save();

        return redirect()->route('sev')->with('success', 'Team member added successfully!');
    }


    /**
     * Update the specified team member in storage.
     */
    public function tupdate(Request $request, $id)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'editUser' => 'required|string|max:255', // Nom complet
            'editPosition' => 'required|string|max:255', // Position
            'editFacebookUrl' => 'nullable|url|max:255', // Lien Facebook
            'editTwitterUrl' => 'nullable|url|max:255', // Lien Twitter
            'editLinkedInUrl' => 'nullable|url|max:255', // Lien LinkedIn
            'editImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image
        ]);

        // Recherche du membre par ID
        $teamMember = Team::findOrFail($id);

        // Mise à jour des champs texte
        $teamMember->name = $validated['editUser'] ?? $teamMember->name; // Garder l'ancienne valeur si manquant
        $teamMember->position = $validated['editPosition'] ?? $teamMember->position;
        $teamMember->facebook_url = $validated['editFacebookUrl'] ?? null; // Null si non fourni
        $teamMember->twitter_url = $validated['editTwitterUrl'] ?? null;
        $teamMember->linkedin_url = $validated['editLinkedInUrl'] ?? null;

        // Gestion de l'image
        if ($request->hasFile('editImage')) {
            $image = $request->file('editImage');

            // Définir le chemin de destination
            $destinationPath = public_path('storage/teams');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Générer un nom unique pour l'image
            $imageName = str_replace(' ', '_', strtolower($validated['editUser'])) . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Supprimer l'ancienne image si elle existe
            if ($teamMember->image && File::exists(public_path('storage/' . $teamMember->image))) {
                File::delete(public_path('storage/' . $teamMember->image));
            }

            // Déplacer la nouvelle image dans le dossier
            $image->move($destinationPath, $imageName);

            // Mettre à jour le chemin de l'image
            $teamMember->image = 'teams/' . $imageName;
        }

        // Sauvegarder les modifications
        $teamMember->save();

        // Redirection avec message de succès
        return redirect()->route('sev')->with('success', 'Team member updated successfully!');
    }

    public function ditte($id)
    {
        $teamMember = Team::findOrFail($id);
        return view('viewadmindste.dashfront', compact('teamMember'));
    }



    public function destroy($id)
    {
        $teamMember = Team::findOrFail($id);

        // Supprimer l'image si elle existe
        if ($teamMember->image && Storage::exists('public/' . $teamMember->image)) {
            Storage::delete('public/' . $teamMember->image);
        }

        $teamMember->delete();

        return redirect()->route('sev')->with('success', 'Team member deleted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Dossier;
use App\Models\Utilisateur as Users;

class UtilisateurController extends Controller
{
    public function getDossier($id)
    {
        $dossier = Dossier::find($id);

        if ($dossier) {
            return response()->json($dossier);
        }

        return response()->json(['success' => false, 'message' => 'Dossier introuvable.'], 404);
    }

    public function updateEmolu(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:dossiers,id',
                'montantwrite' => 'required|numeric',
                'objet' => 'required|string',
                'commentaire' => 'nullable|string|max:500',
            ], [
                'id.required' => 'L\'ID est obligatoire.',
                'id.exists' => 'Le dossier spécifié est introuvable.',
                'montantwrite.required' => 'Le montant est obligatoire.',
                'montantwrite.numeric' => 'Le montant doit être un nombre.',
                'objet.required' => 'L\'objet est obligatoire.',
            ]);

            // Mise à jour du dossier
            $dossier = Dossier::findOrFail($validated['id']);
            $dossier->revenu = $validated['montantwrite'];
            $dossier->objet = $validated['objet'];
            $dossier->commentaire = $validated['commentaire'];
            $dossier->save();

            // Retour du message de succès
            return response()->json(['success' => true, 'message' => 'Modification réussie']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Retourner les erreurs de validation
            return response()->json(['success' => false, 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Gestion des erreurs générales
            return response()->json(['success' => false, 'message' => 'Erreur interne : ' . $e->getMessage()], 500);
        }
    }



    public static function getuser()
    {

        $list = DB::table('utilisateurs');
        $allRole =  Role::all();

        if (request('rec') == 1) {
            if (request('check') != "" && request('check') != null) {
                $list = $list->where('nom', 'like', '%' . request('check') . '%')
                    ->orwhere('prenom', 'like', '%' . request('check') . '%')
                    ->orwhere('login', 'like', '%' . request('check') . '%')->paginate(20);
                return view("viewadmindste.dash_utilisateur", compact('list', 'allRole'));
            } else {
                $list = $list->paginate(20);
                return view("viewadmindste.dash_utilisateur", compact('list', 'allRole'));
            }
        }

        $list = $list->paginate(20);

        return view('viewadmindste.dash_utilisateur', compact('list', 'allRole'));
    }

    public static function deleteuser(Request $request)
    {
        if (!in_array("delete_user", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $occurence = json_encode(Users::where('idUser', request('id'))->first());
            Users::where('idUser', request('id'))->delete();
            $info = "L'utilisateur est supprimé avec succès.";
            TraceController::setTrace(
                "Vous avez supprimé le compte dont les informations sont les suivants : " . $occurence . ".",
                session("utilisateur")->id
            );
            return Back()->with('success', $info);
        }
    }

    public static function reinitialiseruser(Request $request)
    {
        if (!in_array("reset_user", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            Users::where('idUser', request('id'))->update(['password' =>  "com" . sha1('123') . "dste"]);
            $info = "Mot de passe de l'utilisateur est réintialisé avec succès.";
            // Sauvegarde de la trace
            TraceController::setTrace(
                "Vous avez réintialisé le mot de passe du compte de l'utilisateur " . Users::where('idUser', request('id'))->first()->nom . " et dont l'identifiant est " . Users::where('idUser', request('id'))->first()->login . ".",
                session("utilisateur")->idUser
            );
            return Back()->with('success', $info);
        }
    }

    public static function activeuser(Request $request)
    {
        if (!in_array("status_user", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            Users::where('idUser', request('id'))->update(['statut' =>  "0"]);
            $info = "Le compte de l'utilisateur est activé avec succès.";
            // Sauvegarde de la trace
            TraceController::setTrace(
                "Vous avez activé le compte de l'utilisateur " . Users::where('idUser', request('id'))->first()->nom . " et dont l'identifiant est " . Users::where('idUser', request('id'))->first()->login . ".",
                session("utilisateur")->idUser
            );

            return Back()->with('success', $info);
        }
    }

    public static function desactiveuser(Request $request)
    {
        if (!in_array("status_user", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            Users::where('idUser', request('id'))->update(['statut' =>  "1"]);
            $info = "Le compte de l'utilisateur est désactivé avec succès.";
            // Sauvegarde de la trace
            TraceController::setTrace(
                "Vous avez désactivé le compte de l'utilisateur " . Users::where('idUser', request('id'))->first()->nom . " et dont l'identifiant est " . Users::where('idUser', request('id'))->first()->login . ".",
                session("utilisateur")->idUser
            );

            return Back()->with('success', $info);
        }
    }

    public static function adduser(Request $request)
    {
        if (!in_array("add_user", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            if (UtilisateurController::ExisteUser(htmlspecialchars(trim($request->mail)), htmlspecialchars(trim($request->login)))) {

                return Back()->with('error', "L'utilisateur que vous voulez ajouté existe déjà!!");;
            } else {
                $add = new Users();
                $add->nom = htmlspecialchars(trim($request->nom));
                $add->prenom =  htmlspecialchars(trim($request->prenom));
                $add->sexe = htmlspecialchars(trim($request->sexe));
                $add->tel = htmlspecialchars(trim($request->tel));
                $add->mail = htmlspecialchars(trim($request->mail));
                $add->adresse = htmlspecialchars(trim($request->adress));
                $add->login = htmlspecialchars(trim($request->login));
                $add->password = "com" . sha1("123") . "dste";
                $add->Role = $request->role;
                $add->Societe = 1;
                $add->Service = $request->serv;
                $add->other = htmlspecialchars(trim($request->autres));
                $add->user_action = session("utilisateur")->idUser;
                $add->action_save = 's';
                $add->statut = 1;
                $add->auth = htmlspecialchars(trim($request->auth));
                $add->save();

                // Sauvegarde de la trace
                TraceController::setTrace(
                    "Vous avez enregistré l'utilisateur dont le nom est " . $request->prenom . " " . $request->nom . ".",
                    session("utilisateur")->idUser
                );

                //flash("L'utilisateur est enregistré avec succès. ")->success();
                return Back()->with('success', "L'utilisateur est enregistré avec succès.");
            }
        }
    }

    public function getmodifyuser(Request $request)
    {
        if (!in_array("update_user", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $allRole =  Role::all();
            $info = Users::where('idUser', request('id'))->first();
            return view('viewadmindste.modifusers', compact('allRole', 'info'));
        }
    }

    public static function modifyuser(Request $request)
    {
        if (!in_array("update_user", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $request->validate([
                'login' => 'required|string',
            ]);

            Users::where('idUser', request('id'))->update(
                [
                    'nom' =>  htmlspecialchars(trim($request->nom)),
                    'prenom' =>  htmlspecialchars(trim($request->prenom)),
                    'sexe' =>  htmlspecialchars(trim($request->sexe)),
                    'tel' =>  htmlspecialchars(trim($request->tel)),
                    'mail' =>  htmlspecialchars(trim($request->mail)),
                    'adresse' =>  htmlspecialchars(trim($request->adress)),
                    'login' =>  htmlspecialchars(trim($request->login)),
                    'Role' =>  $request->role,
                    'other' => htmlspecialchars(trim($request->autres)),
                    'user_action' => session("utilisateur")->idUser,
                    'action_save' => 's',
                ]
            );
            TraceController::setTrace(
                "Vous avez modifié le compte du personnel " . $request->nom . " " . $request->prenom . " .",
                session("utilisateur")->idUser
            );

            return redirect('/utilisateur')->with('success', "L'utilisateur est modifié avec succès. ");
        }
    }

    public static function ExisteUser($libelleemail, $log)
    {
        $user = Users::where('mail', $libelleemail)->where('login', $log)->first();
        if (isset($user) && $user->idUser != 0) return true;
        else return false;
    }
}
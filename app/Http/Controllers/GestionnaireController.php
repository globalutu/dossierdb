<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\InterfaceServiceProvider;
use DB;
use App\Models\Trace;
use App\Models\Dossier;
use App\Models\Rencontre;
use App\Models\Tresorerie;
use App\Models\Service;
use App\Models\Paramservice;
use Illuminate\Support\Facades\Validator;

class GestionnaireController extends Controller
{

    public function getservices()
    {
        return view('viewadmindste.maquette.listservices');
    }

    public function getparamservices()
    {
        return view('viewadmindste.maquette.paramservices');
    }

    public function getcaisse(Request $request)
    {
        if (!in_array("update_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $info = DB::table("dossiers")->where('id', $request->id)->first();

            $list = DB::table('tresoreries')->where('dossier', $request->id)->paginate(50);

            return view('viewadmindste.maquette.caisse', compact('info', 'list'));
        }
    }

    ////////////////////////////////////Dossiers/////////////////////////////////////////////
    // 
    public function dash(Request $request)
    {
        if ($request->ajax()) {

            $list = DB::table('dossiers')->select("dossiers.*", "services.libelle", "paramservices.typeclient", "utilisateurs.nom as nomuser", "utilisateurs.prenom as prenomuser")
                ->join("paramservices", "paramservices.id", "=", "dossiers.paramservice")
                ->join("services", "paramservices.service", "=", "services.id")
                ->leftJoin("utilisateurs", "utilisateurs.idUser", "=", "dossiers.poste");

            if (!empty(request('check'))) {
                $search = request('check');
                $list = $list->where(function ($query) use ($search) {
                    $query->where('denomination', 'like', '%' . $search . '%')
                        ->orWhere('nom', 'like', '%' . $search . '%')
                        ->orWhere('prenom', 'like', '%' . $search . '%');
                });
            }

            if (session('utilisateur')->Role == 5) {
                $list = $list->where("poste", session('utilisateur')->idUser);
            }

            $response = [
                'success' => true,
                'data'    => $list->orderBy('id', 'desc')->get(),
                'services' => Service::get(),
                'paramservices' => Paramservice::get(),
                'message' => "",
            ];

            return response()->json($response, 200);
        } else {
            return view('viewadmindste.dash');
        }
    }

    public function setdos(Request $request)
    {

        try {

            $messages = [
                'typeclient.required' => 'Le champ type client est requis.',
                'objet.required' => 'Le champ objet est requis.',
                'service.required' => 'Veuillez choisir le type de service avant de continuer.',
            ];

            $validator = Validator::make($request->all(), [
                'typeclient' => 'required|integer',
                'objet' => 'required|string',
                'service' => 'required|integer',
            ], $messages);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $errorString = implode(' ', $errors);

                $response = [
                    'success' => false,
                    'data'    => '',
                    'message' => $errorString,
                ];

                return response()->json($response, 422);
            }

            $nom = "";
            $prenom = "";

            if ($request->typeclient == 2) {
                // personne morale
                $nom = $request->raison;
            }
            if ($request->typeclient == 1) {
                // personne physique
                $nom = $request->nom;
                $prenom = $request->prenom;
            }

            $montantouvertureservice = Paramservice::where('id', $request->service)->first();
            $montantouverture = 0;
            if ($montantouvertureservice) {
                $montantouverture = $montantouvertureservice->ouverture;
            } else {
                $montantouverture = $request->montantwrite;
            }

            $add = new Dossier();
            $add->denomination = $request->typeclient;
            $add->prenom = $prenom;
            $add->nom = $nom;
            $add->objet = $request->objet;
            $add->commentaire = $request->commentaire;
            $add->montant = $montantouverture;
            $add->datedebut = $request->datedebut;
            $add->datefin = $request->datefin;
            $add->paramservice = $request->service;
            $add->save();

            $response = [
                'success' => true,
                'data'    => '',
                'message' => "Enregistrement effectué avec succès.",
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {

            \Log::info("Erreur : " . $e);
            $response = [
                'success' => false,
                'data'    => '',
                'message' => 'Une erreur est survenue lors de l\'enregistrement.',
            ];

            return response()->json($response, 500);
        }
    }

    public function deldos(Request $request)
    {
        if (!in_array("delete_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $occurence = json_encode(Dossier::where('id', request('id'))->first());
            $addt = new Trace();
            $addt->libelle = "Dossier supprimé : " . $occurence;
            $addt->action = session("utilisateur")->idUser;
            $addt->save();
            Dossier::where('id', request("id"))->delete();
            flash("Suppression effectué avec succès.");
            return Back();
        }
    }

    public function getmdos(Request $request)
    {
        if (!in_array("update_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $info = DB::table("dossiers")->where('id', $request->id)->first();

            return view('viewadmindste.modifvcs', compact('info'));
        }
    }

    public function setmdos(Request $request)
    {
        if (!in_array("update_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $request->validate([
                'prenom' => 'required|string',
                'nom' => 'required|string',
                'objet' => 'required|string',
                'montant' => 'required|integer',
                'datedebut' => 'required|date',

            ]);

            Dossier::where('id', request('id'))->update(
                [
                    'prenom' =>  htmlspecialchars(trim($request->prenom)),
                    'nom' =>  htmlspecialchars(trim($request->nom)),
                    'objet' => htmlspecialchars(trim($request->objet)),
                    'montant' => htmlspecialchars(trim($request->montant)),
                    'datedebut' => htmlspecialchars(trim($request->datedebut)),
                    'datefin' => htmlspecialchars(trim($request->datefin)),
                ]
            );
            flash("Modification effectué avec succès. ")->success();
            TraceController::setTrace(
                "Vous avez modifié une donnée " . $request->libelle . " .",
                session("utilisateur")->idUser
            );
            return redirect('/dashboard');
        }
    }

    public function getalluserssys(Request $request)
    {
        return json_encode(["data" => DB::table('utilisateurs')->where("Role", 5)->get()]);
    }

    public function affectUserInPoste(Request $request)
    {
        try {
            $dossier = Dossier::where('id', request('idaffect'))->first();

            $name = $dossier->nom . ' ' . $dossier->prenom;

            $utilisateur = InterfaceServiceProvider::LibelleUser($request->user);

            Dossier::where('id', request('idaffect'))->update(
                [
                    'poste' => $request->user,
                ]
            );
            $message = "Vous avez affecter le dossier de `" . $name . "` à l'utilisateur " . $utilisateur;
            // Envoie un mail

            TraceController::setTrace($message, session("utilisateur")->idUser);
            return $message;
        } catch (\Exception $e) {
            return Back()->with('error', "Une erreur ses produites :" . $e->getMessage());
        }
    }

    public function reaffecteruser(Request $request)
    {
        try {

            $dossier = Dossier::where('id', request('idaff'))->first();

            $ancienuser = $dossier->poste;

            $name = $dossier->nom . ' ' . $dossier->prenom;

            if ($ancienuser == request('idreaffect')) {
                // Pas de mise à jour
                return "Aucun changement n'est fait sur l'outil. ";
            } else {
                if (request('idreaffect') == 0) {
                    // Retrait de l'outil d'un utilisateur
                    $utilisateur = InterfaceServiceProvider::LibelleUser($dossier->poste);

                    Dossier::where('id', request('idaff'))->update(
                        [
                            'poste' => null,
                        ]
                    );
                    $message = "Vous avez retiré `" . $name . "` à " . $utilisateur;
                    // Envoie un mail
                    TraceController::setTrace($message, session("utilisateur")->idUser);
                    return $message;
                } else {
                    // Changement
                    $ancienutilisateur = InterfaceServiceProvider::LibelleUser($dossier->user);

                    $nouveauutilisateur = InterfaceServiceProvider::LibelleUser($request->idreaffect);

                    Dossier::where('id', request('idaff'))->update(
                        [
                            'poste' => $request->idreaffect,
                        ]
                    );
                    $message = "Vous avez retiré `" . $name . "` à " . $ancienutilisateur . " et l’avez réaffecté à " . $nouveauutilisateur;
                    // Envoie un mail
                    TraceController::setTrace($message, session("utilisateur")->idUser);
                    return $message;
                }
            }
        } catch (\Exception $e) {
            return Back()->with('error', "Une erreur ses produites :" . $e->getMessage());
        }
    }

    /////////////////////////////// Fin dossiers /////////////////////////////////////////////

    /////////////////////////////// Rencontre ////////////////////////////////////////////////

    public function getrencontredos(Request $request)
    {
        if (!in_array("update_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $info = DB::table("dossiers")->where('id', $request->id)->first();

            $list = DB::table('rencontres')->where('dossier', $request->id)->paginate(50);

            return view('viewadmindste.rdv', compact('info', 'list'));
        }
    }

    public function setrencontredos(Request $request)
    {

        if (isset(Rencontre::where("id", $request->idrct)->first()->id)) {
            Rencontre::where("id", $request->idrct)->update([
                "nom" => $request->nom,
                "structure" => $request->structure,
                "resultat" => $request->resultat,
                "date" => $request->daterdv,
                "commentaire" => $request->commentaire,
            ]);

            return json_encode(["status" => 0, "messages" => "Modification effectué avec succès "]);
        } else {

            $request->validate([
                'commentaire' => 'required|string',
                'nom' => 'required|string',
                'resultat' => 'required|string',
                'structure' => 'required|string',
            ]);

            $add = new Rencontre();
            $add->dossier = $request->id;
            $add->nom = $request->nom;
            $add->structure = $request->structure;
            $add->resultat = $request->resultat;
            $add->date = $request->daterdv;
            $add->commentaire = $request->commentaire;
            $add->save();

            flash("Vous avez exécuter une rencontre. Enregistrement effectué avec succès.");



            return Back();
        }
    }

    public function delrencontre(Request $request)
    {
        if (!in_array("delete_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $occurence = json_encode(Rencontre::where('id', request('id'))->first());
            $addt = new Trace();
            $addt->libelle = "Rencontre supprimé : " . $occurence;
            $addt->action = session("utilisateur")->idUser;
            $addt->save();
            Rencontre::where('id', request("id"))->delete();
            $info = "Suppression effectué avec succès.";
            return $info;
        }
    }

    /////////////////////////////// Fin rencontre /////////////////////////////////////////////

    /////////////////////////////// Trésorerie ///////////////////////////////////////////////

    public function gettresoreriedos(Request $request)
    {
        if (!in_array("update_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $info = DB::table("dossiers")->where('id', $request->id)->first();

            $list = DB::table('tresoreries')->where('dossier', $request->id)->paginate(50);

            return view('viewadmindste.tresorerie', compact('info', 'list'));
        }
    }

    public function settresoreriedos(Request $request)
    {

        $request->validate([
            'lib' => 'required|string',
            'entre' => 'required|integer',
        ]);

        $dossier = Dossier::where('id', $request->id)->first();

        if ($request->op == 1) {
            $add = new Tresorerie();
            $add->dossier = $request->id;
            $add->libelle = $request->lib;
            $add->entre = $request->montant;
            $add->restant = ($dossier->montant + $dossier->revenu) - ($dossier->payer + $request->montant);
            $add->solde = $dossier->solde + $request->montant;
            $add->date = $request->date;
            $add->save();

            // update montant payer in dossier
            $dossier->payer = ($dossier->payer + $request->montant);
            $dossier->solde = $dossier->solde + $request->montant;
            $dossier->save();

            flash('Enregistrement effectué avec succès.');
        }


        return Back();
    }

    public function deltresor(Request $request)
    {
        if (!in_array("delete_vc", session("auto_action"))) {
            return view("vendor.error.649");
        } else {
            $sole = Tresorerie::where('id', request('id'))->first();

            $payer = Dossier::where('id', $sole->dossier)->first()->payer;

            // update montant payer in dossier
            Dossier::where('id', $sole->dossier)->update(
                [
                    'payer' => $payer - $sole->entre,
                ]
            );

            $occurence = json_encode($sole);
            $addt = new Trace();
            $addt->libelle = "Tresorerie supprimé : " . $occurence;
            $addt->action = session("utilisateur")->idUser;
            $addt->save();
            Tresorerie::where('id', request("id"))->delete();
            $info = "Suppression effectué avec succès.";
            return $info;
        }
    }

    ////////////////////////////// Fin trésorerie ///////////////////////////////////////////

}
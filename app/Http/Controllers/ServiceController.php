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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;



class ServiceController extends Controller
{

    public function getservices(Request $request)
    {

        if ($request->ajax()) {

            $response = [
                'success' => true,
                'data'    => Service::get(),
                'message' => "",
            ];

            return response()->json($response, 200);
        } else {
            return view('viewadmindste.mdp_onontio_services.listservices');
        }
    }

    public function setservice(Request $request)
    {

        try {

            // Caractères à remplacer
            $search = ['"', "'", '\\', '/'];
            $replace = ' ';

            str_replace($search, $replace, $request->denom);

            $messages = [
                'denom.required' => 'Le champ libellé est requis.',
                'denom.unique' => 'La valeur saisie existe déjà.',
                'denom.max' => 'La taille maximale est de 255 caractères.',
                'denom.string' => 'La valeur doit être alphabétique.',
            ];

            $validator = Validator::make($request->all(), [
                'denom' => 'required|string|max:255|unique:services,libelle',
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

            $add = new Service();
            $add->libelle = str_replace($search, $replace, $request->denom);
            $add->save();

            $response = [
                'success' => true,
                'data'    => '',
                'message' => "Enregistrement effectué avec succès.",
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data'    => '',
                'message' => 'Une erreur est survenue lors de l\'enregistrement.',
            ];

            return response()->json($response, 500);
        }
    }

    public function setupdateservice(Request $request)
    {

        try {

            // Caractères à remplacer
            $search = ['"', "'", '\\', '/'];
            $replace = ' ';

            $messages = [
                'denom.required' => 'Le champ libellé est requis.',
                'denom.unique' => 'La valeur saisie existe déjà.',
                'denom.max' => 'La taille maximale est de 255 caractères.',
                'denom.string' => 'La valeur doit être alphabétique.',
            ];

            $validator = Validator::make($request->all(), [
                'denom' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('services', 'libelle')->ignore($request->id),
                ],
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

            // Code pour mettre à jour l'enregistrement
            $service = Service::find($request->id);
            $service->libelle = str_replace($search, $replace, $request->denom);
            $service->save();

            $response = [
                'success' => true,
                'data'    => '',
                'message' => "Enregistrement mis à jour avec succès.",
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data'    => '',
                'message' => 'Une erreur est survenue lors de l\'enregistrement.',
            ];

            return response()->json($response, 500);
        }
    }

    public function delservice(Request $request)
    {
        $service = Service::where('id', request('id'))->first();

        $occurence = json_encode($service);
        $dataassoc = json_encode(Paramservice::where('service', $service->id)->get());
        $addt = new Trace();
        $addt->libelle = "Service supprimé : " . $occurence;
        $addt->action = session("utilisateur")->idUser;
        $addt->save();
        Service::where('id', request("id"))->delete();
        Paramservice::where('service', $service->id)->delete();
        $response = [
            'success' => true,
            'data'    => '',
            'message' => "Suppression effectué avec succès.",
        ];

        return response()->json($response, 200);
    }

    public function getparamservice(Request $request)
    {
        $response = [
            'success' => true,
            'data'    => Paramservice::where('service', $request->id)->get(),
            'message' => "",
        ];

        return response()->json($response, 200);
    }

    public function setparamservice(Request $request)
    {

        try {

            $messages = [
                'typeclient.required' => 'Le champ type client est requis.',
                'id.required' => 'Le champ service est requis.',
                'ouverture.required' => 'Le champ ouverture est requis.',
                'montant.required' => 'Le champ montant est requis.',
                'taux.required' => 'Le champ taux est requis.',
                'tranchemin.required' => 'Le champ tranche min est requis.',
                'tranchemax.required' => 'Le champ tranche max est requis.',
            ];

            $validator = Validator::make($request->all(), [
                'typeclient' => 'required|integer',
                'id' => 'required|integer',
                'ouverture' => 'required|integer',
                'montant' => 'required|integer',
                'taux' => 'required|integer',
                'tranchemin' => 'required|integer',
                'tranchemax' => 'required|integer',
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

            // Vérification personnalisée
            $exists = Paramservice::where('service', $request->id)
                ->where('typeclient', $request->typeclient)
                ->where('ouverture', $request->ouverture)
                ->where('montantcontrat', $request->montant)
                ->where('tauxcontrat', $request->taux)
                ->where('tranchemin', $request->tranchemin)
                ->where('tranchemax', $request->tranchemax)
                ->exists();

            if ($exists) {
                $response = [
                    'success' => false,
                    'data'    => '',
                    'message' => $errorString,
                ];
                return response()->json($response, 422);
            }

            $add = new Paramservice();
            $add->service = $request->id;
            $add->typeclient = $request->typeclient;
            $add->ouverture = $request->ouverture;
            $add->montantcontrat = $request->montant;
            $add->tauxcontrat = $request->taux;
            $add->tranchemin = $request->tranchemin;
            $add->tranchemax = $request->tranchemax;
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
    // hilaire sevn 





    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'editServiceImage' => 'nullable|image|max:2048', // Validation pour l'image
        ]);

        $service = Service::findOrFail($id);

        // Vérifie si une nouvelle image est téléchargée
        if ($request->hasFile('editServiceImage')) {
            $image = $request->file('editServiceImage');

            // Crée le dossier 'services' s'il n'existe pas
            $destinationPath = public_path('storage/services');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Renomme l'image avec l'ID du service et un timestamp
            $imageName = 'service_' . $service->id . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Supprime l'ancienne image si elle existe
            if ($service->image && File::exists(public_path('storage/' . $service->image))) {
                File::delete(public_path('storage/' . $service->image));
            }

            // Déplace la nouvelle image dans le dossier 'services'
            $image->move($destinationPath, $imageName);

            // Met à jour le chemin de l'image
            $service->image = 'services/' . $imageName;
            $service->save();
        }

        return redirect()->route('sev')->with('success', 'Service image updated successfully!');
    }
}
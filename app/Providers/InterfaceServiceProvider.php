<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Models\Incident;

class InterfaceServiceProvider extends ServiceProvider
{

    public static function LibService($id){
        return DB::table('services')->where('id', $id)->first()->libelle;
    }
    
    public static function destinataire(){
        return ["emmanueldjidagbagba@gmail.com", "roger.kpovihouede@groupensia.com"];
    }

    public static function nombredejoursinmois($mois, $annee)
    {
        $mois = mktime( 0, 0, 0, $mois, 1, $annee );
        return intval(date("t",$mois));
    }

    public static function allutilisateurs()
    {
        return DB::table('utilisateurs')->where("Role", 5)->get();
    }

    public static function statis($trim, $heri)
    {
        switch ($trim) {
            case 1:
                $result = Incident::where("hierarchie", $heri);
                if(session('utilisateur')->Role != 1 || session('utilisateur')->Role != 2)
                    $result = $result->where("Emetteur", session("utilisateur")->idUser);
                
                $result = $result->where(function ($query) {
                            $query->whereMonth('created_at', '01')
                             ->orWhereMonth('created_at', '02')
                             ->orWhereMonth('created_at', '03');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                return $result;
                break;
            case 2:
                $result = Incident::where("hierarchie", $heri);
                if(session('utilisateur')->Role != 1 || session('utilisateur')->Role != 2)
                    $result = $result->where("Emetteur", session("utilisateur")->idUser);
                
                $result = $result->where("hierarchie", $heri)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '04')
                             ->orWhereMonth('created_at', '05')
                             ->orWhereMonth('created_at', '06');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                return $result;
                break;
            case 3:
                $result = Incident::where("hierarchie", $heri);
                if(session('utilisateur')->Role != 1 || session('utilisateur')->Role != 2)
                    $result = $result->where("Emetteur", session("utilisateur")->idUser);
                
                $result = $result->where(function ($query) {
                            $query->whereMonth('created_at', '07')
                             ->orWhereMonth('created_at', '08')
                             ->orWhereMonth('created_at', '09');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                return $result;
                break;
            case 4:
                $result = Incident::where("hierarchie", $heri);
                if(session('utilisateur')->Role != 1 || session('utilisateur')->Role != 2)
                    $result = $result->where("Emetteur", session("utilisateur")->idUser);
                
                $result = $result->where(function ($query) {
                            $query->whereMonth('created_at', '10')
                             ->orWhereMonth('created_at', '11')
                             ->orWhereMonth('created_at', '12');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                return $result;
                break;
            default:
                # code...
                break;
        }
    }

    public static function nombrejourstrimestre($trim, $annee)
    {
        $resul = 0;
        switch ($trim) {
            case 1:
                $resul = InterfaceServiceProvider::nombredejoursinmois(1, $annee) + InterfaceServiceProvider::nombredejoursinmois(2, $annee) + InterfaceServiceProvider::nombredejoursinmois(3, $annee);
                break;
            case 2:
                $resul = InterfaceServiceProvider::nombredejoursinmois(4, $annee) + InterfaceServiceProvider::nombredejoursinmois(5, $annee) + InterfaceServiceProvider::nombredejoursinmois(6, $annee);
                break;
            case 3:
                $resul = InterfaceServiceProvider::nombredejoursinmois(7, $annee) + InterfaceServiceProvider::nombredejoursinmois(8, $annee) + InterfaceServiceProvider::nombredejoursinmois(9, $annee);
                break;
            case 4:
                $resul = InterfaceServiceProvider::nombredejoursinmois(10, $annee) + InterfaceServiceProvider::nombredejoursinmois(11, $annee) + InterfaceServiceProvider::nombredejoursinmois(12, $annee);
                break;
            default:
                $resul = 0;
                break;
        }
        return $resul;
    }

    public static function enAttente($trim)
    {
        switch ($trim) {
            case 1:
                return Incident::where('statut', '!=',1)
                        ->where('DateResolue', null)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '01')
                             ->orWhereMonth('created_at', '02')
                             ->orWhereMonth('created_at', '03');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            case 2:
                return Incident::where('statut', '!=',1)
                        ->where('DateResolue', null)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '04')
                             ->orWhereMonth('created_at', '05')
                             ->orWhereMonth('created_at', '06');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            case 3:
                return Incident::where('statut', '!=',1)
                        ->where('DateResolue', null)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '07')
                             ->orWhereMonth('created_at', '08')
                             ->orWhereMonth('created_at', '09');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            case 4:
                return Incident::where('statut', '!=',1)
                        ->where('DateResolue', null)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '10')
                             ->orWhereMonth('created_at', '11')
                             ->orWhereMonth('created_at', '12');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            default:
                # code...
                break;
        }
    }

    public static function resolue($trim)
    {
        switch ($trim) {
            case 1:
                return Incident::where('statut', '=',1)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '01')
                             ->orWhereMonth('created_at', '02')
                             ->orWhereMonth('created_at', '03');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            case 2:
                return Incident::where('statut', '=',1)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '04')
                             ->orWhereMonth('created_at', '05')
                             ->orWhereMonth('created_at', '06');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            case 3:
                return Incident::where('statut', '=',1)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '07')
                             ->orWhereMonth('created_at', '08')
                             ->orWhereMonth('created_at', '09');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            case 4:
                return Incident::where('statut', '=',1)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '10')
                             ->orWhereMonth('created_at', '11')
                             ->orWhereMonth('created_at', '12');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->get()->count();
                break;
            default:
                # code...
                break;
        }
    }

    public static function indisponibiliteapplication($trim)
    {
        switch ($trim) {
            case 1:
                return Incident::
                        select( DB::raw('SUM(DATEDIFF(DateResolue, DATE_FORMAT(created_at, "%Y-%m-%d"))) as jours '))
                        ->where('statut', '=',1)
                        ->where('cat', 6)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '01')
                             ->orWhereMonth('created_at', '02')
                             ->orWhereMonth('created_at', '03');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->first();
                break;
            case 2:
                return Incident::
                        select( DB::raw('SUM(DATEDIFF(DateResolue, DATE_FORMAT(created_at, "%Y-%m-%d"))) as jours '))
                        ->where('statut', '=',1)
                        ->where('cat', 6)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '04')
                             ->orWhereMonth('created_at', '05')
                             ->orWhereMonth('created_at', '06');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->first();
                break;
            case 3:
                return Incident::
                        select( DB::raw('SUM(DATEDIFF(DateResolue, DATE_FORMAT(created_at, "%Y-%m-%d"))) as jours '))
                        ->where('statut', '=',1)
                        ->where('cat', 6)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '07')
                             ->orWhereMonth('created_at', '08')
                             ->orWhereMonth('created_at', '09');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->first();
                break;
            case 4:
                return Incident::
                        select( DB::raw('SUM(DATEDIFF(DateResolue, DATE_FORMAT(created_at, "%Y-%m-%d"))) as jours '))
                        ->where('statut', '=',1)
                        ->where('cat', 6)
                        ->where(function ($query) {
                            $query->whereMonth('created_at', '10')
                             ->orWhereMonth('created_at', '11')
                             ->orWhereMonth('created_at', '12');
                            })
                        ->whereYear('created_at', '=', date('Y'))
                        ->first();
                break;
            default:
                # code...
                break;
        }
    }


	public static function LibelleRole($id)
    {
    	$role = DB::table('roles')->where('idRole', $id)->first();
    	if(isset($role->libelle))
        	return $role->libelle;  
        return "";      
    }

    public static function sexe($sigle)
    {
        if ($sigle == 'M') return "Masculin";
        if ($sigle == 'F') return "Féminin";
    }

    public static function LibelleUser($id)
    {
        $user = DB::table('utilisateurs')->where('idUser', $id)->first();
        return $user->nom.' '.$user->prenom;        
    }

    public static function AllRole()
    {
        return DB::table('roles')->get();
    }

    public static function AllService()
    {
        return DB::table('services')->get();
    }

    public static function LibelleService($id)
    {
        if($id == null)
            return "";
        return DB::table('services')->where('id', $id)->first()->libelle;
    }

    public static function AllCat()
    {
        return DB::table('categories')->get();
    }

    public static function LibelleCat($id)
    {
        return DB::table('categories')->where('id', $id)->first()->libelle;
    }
    
    public static function TempsCat($id)
    {
        return DB::table('categories')->where('id', $id)->first()->tmpCat;
    }

    public static function AllHie()
    {
        return DB::table('hierarchies')->get();
    }

    public static function LibelleHier($id)
    {
        return DB::table('hierarchies')->where('id', $id)->first()->libelle;
    }

    public static function libmenu($id)
    {
        if ($id == 0) {
            return '';
        }else
            return DB::table('menus')->where('idMenu', $id)->first()->libelleMenu;
    }
    public static function recupactions($value)
    { 
        return DB::table('action_menus')->where('Menu', $value)->get();
    }

    public static function actionMenu($menu)
    {
        return DB::table('action_menus')->where('Menu', $menu)->get();
    }

    public static function infomenu($id)
    {
        return DB::table('menus')->where('idMenu', $id)->first();
    }

    public static function verifie_ss($ssm)
    {
        $allmenu_sous = DB::table('action_menu_acces')->join('menus', "menus.idMenu", "=", "action_menu_acces.Menu")->select('Menu', 'Topmenu_id')->where('Role', session('utilisateur')->Role)->where('Topmenu_id', '<>', 0)->where('action_menu_acces.statut', 0)->orderby('num_ordre', 'ASC')->get();

        $val = false;
        foreach($allmenu_sous as $all){
            if ($all->Topmenu_id == $ssm) {
                $val = true;
            }
        }
        return $val;
    }
}
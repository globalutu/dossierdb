<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\TraceController;
use Illuminate\Support\Facades\Session;
use Auth;
use DB;
use App\Models\Utilisateur as Users;

class LoginController extends Controller
{

    public static function login()
    {
        if(request('f') != null)
        {
            $error = "Identifiant ou mot de passe incorrect.";flash($error)->error(); return Back();
        }
        if(request('d') != null)
        {
            if (!isset(Users::where('login',request('d'))->first()->idUser)) {
                $error = "Identifiant n'existe pas dans sur la plateforme.";flash($error)->error(); return Back();                                
            }else{
                $user = Users::where('login',request('d'))->first();
                                            
                if ($user->statut == "1") {
                    $error = "Votre compte n'est pas activé. Veuillez vous rapprocher de l'administrateur pour plus d'informations.";
                    //flash()->overlay($error, "Erreur lors de l'authentification : ");
                    flash($error)->error();
                    return Back();
                }
                            
                Session::put('utilisateur', $user); 
                // menu
                $allmenu_autoriser = DB::table('action_menu_acces')->join('menus', "menus.idMenu", "=", "action_menu_acces.Menu")->select('Menu')->where('Role', $user->Role)->where('Topmenu_id', 0)->where('action_menu_acces.statut', 0)->orderby('menus.created_at', 'desc')->get();
                $array = array();
                foreach($allmenu_autoriser as $all){
                    if (!in_array($all->Menu, $array)) {
                        array_push($array, $all->Menu);
                    }
                }
                // sous menu
                $allmenu_sous = DB::table('action_menu_acces')->join('menus', "menus.idMenu", "=", "action_menu_acces.Menu")->select('Menu')->where('Role', $user->Role)->where('Topmenu_id', '<>', 0)->where('action_menu_acces.statut', 0)->orderby('num_ordre', 'ASC')->get();
                $array_ss = array();
                foreach($allmenu_sous as $all){
                    if (!in_array($all->Menu, $array_ss)) {
                        array_push($array_ss, $all->Menu);
                                                }
                }
                // action
                $allaction_autoriser = DB::table('action_menu_acces')->select('ActionMenu', 'Menu')->where('Role', $user->Role)->where('statut', 0)->get();
                //dd($allaction_autoriser);
                $allAction = array();
                foreach ($allaction_autoriser as $value) {
                    if ($value->ActionMenu != 0) {
                        $all_act = DB::table('action_menus')->where('id', $value->ActionMenu)->first()->code_dev;
                        array_push($allAction, $all_act);
                    }
                }
                Session::put('auto_menu', $array);
                Session::put('auto_ss_menu', $array_ss);
                Session::put('auto_action', $allAction);
                Session::put('DateConnexion', date("Y-m-d"));
                //flash("Message avec succes");
                TraceController::setTrace(
                session('utilisateur')->nom." ".session('utilisateur')->prenom. "! Vous vous êtes bien connecté aujourd'hui ".date("d-m-Y à H:i:s"),session("utilisateur")->idUser);
                return  redirect()->intended('dashboard');
            }       
        }else{
            if (Users::count() == 0) {
                $add = new Users();
                $add->nom = "DJIDAGBAGBA";
                $add->prenom = "S T Emmanuel";
                $add->sexe = "M"; 
                $add->tel = "61310573";
                $add->mail = "emmanueldjidagbagba@gmail.com";
                $add->adresse = "Cotonou";
                $add->login = "kanths";
                $add->password = "com".sha1("caro@123")."dste";
                $add->Role = 1;
                $add->other = "Analyste Concepteur; Développeur; DBA Oracle; Formateur; ";
                $add->user_action = 1;
                $add->action_save = 's';
                $add->save();
            }
    
            Session()->forget('utilisateur');
            Session()->forget('auto_ss_menu');
            Session()->forget('auto_action');
            Session()->forget('DateConnexion');
            return view('auth.login');
        }
    }

    public static function authenticate(Request $request) 
    {
        
        if (request('libelle') == "connexion") {
            $request->validate([
                'login' => 'required|string', 
                'password' => 'required|string',
            ]);

                $user = Users::where('login',$request->login)
                                    ->where('password', "com".sha1(request('password'))."dste")
                                    ->first();
                    
                if (isset($user) && $user->idUser != 0) {
                   // Vérification si c'est le mot de passe par defaut
                    // Par défaut password = 123 => com40bd001563085fc35165329ea1ff5c5ecbdbbeefdste
                    if ($user->password == "com40bd001563085fc35165329ea1ff5c5ecbdbbeefdste") {
                        $error = "Le mot de passe est un mot de passe par défaut. Veuillez changer le mot de passe.";
                        //flash()->overlay($error, "Erreur lors de l'authentification : ");
                        flash($error)->error();
                        return Back();
                    }
                    if ($user->statut == "1") {
                        $error = "Votre compte n'est pas activé. Veuillez vous rapprocher de l'administrateur pour plus d'informations.";
                        //flash()->overlay($error, "Erreur lors de l'authentification : ");
                        flash($error)->error();
                        return Back();
                    }
    
                    Session::put('utilisateur', $user); 
                    // menu
                    $allmenu_autoriser = DB::table('action_menu_acces')->join('menus', "menus.idMenu", "=", "action_menu_acces.Menu")->select('Menu')->where('Role', $user->Role)->where('Topmenu_id', 0)->where('action_menu_acces.statut', 0)->orderby('menus.created_at', 'desc')->get();
                    $array = array();
                    foreach($allmenu_autoriser as $all){
                        if (!in_array($all->Menu, $array)) {
                            array_push($array, $all->Menu);
                        }
                    }
                    // sous menu
                    $allmenu_sous = DB::table('action_menu_acces')->join('menus', "menus.idMenu", "=", "action_menu_acces.Menu")->select('Menu')->where('Role', $user->Role)->where('Topmenu_id', '<>', 0)->where('action_menu_acces.statut', 0)->orderby('num_ordre', 'ASC')->get();
                    $array_ss = array();
                    foreach($allmenu_sous as $all){
                        if (!in_array($all->Menu, $array_ss)) {
                            array_push($array_ss, $all->Menu);
                        }
                    }
                    // action
                    $allaction_autoriser = DB::table('action_menu_acces')->select('ActionMenu', 'Menu')->where('Role', $user->Role)->where('statut', 0)->get();
                    //dd($allaction_autoriser);
                    $allAction = array();
                    foreach ($allaction_autoriser as $value) {
                        if ($value->ActionMenu != 0) {
                            $all_act = DB::table('action_menus')->where('id', $value->ActionMenu)->first()->code_dev;
                            array_push($allAction, $all_act);
                        }
                    }
                    Session::put('auto_menu', $array);
                    Session::put('auto_ss_menu', $array_ss);
                    Session::put('auto_action', $allAction);
                    Session::put('DateConnexion', date("Y-m-d"));
                    //flash("Message avec succes");
                    TraceController::setTrace(
                    session('utilisateur')->nom." ".session('utilisateur')->prenom. "! Vous vous êtes bien connecté aujourd'hui ".date("d-m-Y à H:i:s"),
                    session("utilisateur")->idUser);
                    return  redirect()->intended('dashboard');
                }$error = "Identifiant ou mot de passe incorrect.";flash($error)->error(); return Back();
            
            
        } 

        if (request('libelle') == "modifier") {
            $user = Users::where('login', request("login"))
                    ->where('password', "com".sha1(request('ancien_pass'))."dste")
                    ->first();
            if (isset($user) && $user->idUser != 0) { 
                if (request('new_pass') != request('confir_pass')) {
                    $error = "La confirmation du mode de passe est incorrect!";flash($error)->error(); return Back();    
                }elseif("com".sha1(request('new_pass'))."dste" == "com40bd001563085fc35165329ea1ff5c5ecbdbbeefdste"){
                    $error = "Veuillez saisir un autre mot de passe.";flash($error)->error(); return Back();
                } 
                else {
                    if ($user->statut == "1") {
                        $error = "Votre compte n'est pas activé. Veuillez vous rapprocher de l'administrateur pour plus d'informations.";
                        //flash()->overlay($error, "Erreur lors de l'authentification : ");
                        flash($error)->error();
                        return Back();
                    }
                    Users::where('login', request('login'))->update(['password' =>  "com".sha1(request('new_pass'))."dste"]);
                        //flash("Message avec succes");
                    Session::put('utilisateur', $user);
                    // menu
                    $allmenu_autoriser = DB::table('action_menu_acces')->join('menus', "menus.idMenu", "=", "action_menu_acces.Menu")->select('Menu')->where('Role', $user->Role)->where('Topmenu_id', 0)->where('action_menu_acces.statut', 0)->orderby('menus.created_at', 'desc')->get();
                    $array = array();
                    foreach($allmenu_autoriser as $all){
                        if (!in_array($all->Menu, $array)) {
                            array_push($array, $all->Menu);
                        }
                    }
                    // sous menu
                    $allmenu_sous = DB::table('action_menu_acces')->join('menus', "menus.idMenu", "=", "action_menu_acces.Menu")->select('Menu')->where('Role', $user->Role)->where('Topmenu_id', '<>', 0)->where('action_menu_acces.statut', 0)->orderby('num_ordre', 'ASC')->get();
                    $array_ss = array();
                    foreach($allmenu_sous as $all){
                        if (!in_array($all->Menu, $array_ss)) {
                            array_push($array_ss, $all->Menu);
                        }
                    }
                    // action
                    $allaction_autoriser = DB::table('action_menu_acces')->select('ActionMenu', 'Menu')->where('Role', $user->Role)->where('statut', 0)->get();
                    //dd($allaction_autoriser);
                    $allAction = array();
                    foreach ($allaction_autoriser as $value) {
                        if ($value->ActionMenu != 0) {
                            $all_act = DB::table('action_menus')->where('id', $value->ActionMenu)->first()->code_dev;
                            array_push($allAction, $all_act);
                        }
                    }
                    Session::put('auto_menu', $array);
                    Session::put('auto_ss_menu', $array_ss);
                    Session::put('auto_action', $allAction);
                    Session::put('DateConnexion', date("Y-m-d"));
                    //flash("Message avec succes");
                    TraceController::setTrace(
                    session('utilisateur')->nom." ".session('utilisateur')->prenom. "! Vous vous êtes bien connecté aujourd'hui ".date("d-m-Y à H:i:s"),
                    session("utilisateur")->idUser);
                    return  redirect()->intended('dashboard');
                }
            }else{
                $error = "Identifiant ou ancien mot de passe incorrect!";flash($error)->error(); return Back();
            }
        }   
    }
    

    public static function passmodif()
    {
        return view('auth.password');
    }

    public function logout() {
      Auth::logout();
      Session::put('utilisateur', "");
      Session::put('auto_menu', "");
      Session::put('auto_ss_menu', "");
      Session::put('auto_action', "");
      Session::put('DateConnexion', "");
      return redirect('connexion');
    }
    
    public function authp($username, $password, $domain = 'NSIA', $endpoint = 'ldaps://nsia.com', $dc = 'dc=nsia,dc=com') {
        putenv('LDAPTLS_REQCERT=never');
    	$ldap = @ldap_connect($endpoint);
    	if(!$ldap) return false;
    
    	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    	ldap_start_tls($ldap);
    
    	$bind = @ldap_bind($ldap, "$domain\\$username", $password);
    	if(!$bind) return false;
    
    	$result = @ldap_search($ldap, $dc, "(sAMAccountName=$username)");
    	if(!$result) return false;
    
    	@ldap_sort($ldap, $result, 'sn');
    	$info = @ldap_get_entries($ldap, $result);
    	if(!$info) return false;
    	if(!isset($info['count']) || $info['count'] !== 1) return false;
    
    	$data = [];
    
    	foreach($info[0] as $key => $value) {
    		if(is_numeric($key)) continue;
    		if($key === 'count') continue;
    
    		$data[$key] = (array)$value;
    		unset($data[$key]['count']);
    	}
    
    	return [
    		'mail' => $data['mail'][0],
    		'displayname' => $data['displayname'][0]
    	];
    }
}

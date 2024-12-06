<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController; // Importer Artisan

Route::get('/cach', function () {
	Artisan::call('Config:cache');
});

Route::get('/', 'App\Http\Controllers\LoginController@login')->name('hoL');
Route::get('/connexion', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('/loginapi', 'App\Http\Controllers\LoginController@loginapi')->name('logapi');
Route::post('/connexion', 'App\Http\Controllers\LoginController@authenticate')->name('loginS');
Route::get('/mot-de-passe-oublié', 'App\Http\Controllers\LoginController@passmodif')->name('pass');

Route::fallback(function () {
	return view('vendor.error.404');
});

Route::group([
	'middleware' => 'App\Http\Middleware\Autorisation'

], function () {

	Route::get('/deconnexion', 'App\Http\Controllers\LoginController@logout')->name('logout');


	//////////////////////////////////** SERVICES ONONTIO **////////////////////////////////////////////////////
	Route::get('/services', 'App\Http\Controllers\ServiceController@getservices')->name('GVSO');
	Route::post('/services', 'App\Http\Controllers\ServiceController@setservice')->name('SSO');
	Route::post('/updateservices', 'App\Http\Controllers\ServiceController@setupdateservice')->name('SUSO');
	Route::post('/deleteservices', 'App\Http\Controllers\ServiceController@delservice')->name('DSO');
	Route::post('/paramservices', 'App\Http\Controllers\ServiceController@getparamservice')->name('GPSO');
	Route::post('/setparamservices', 'App\Http\Controllers\ServiceController@setparamservice')->name('SPSO');


	//////////////////////////////////** MAQUETTE **////////////////////////////////////////////////////////////
	Route::get('/paramservices', 'App\Http\Controllers\GestionnaireController@getparamservices')->name('GPSVC');
	Route::get('/caisse', 'App\Http\Controllers\GestionnaireController@getcaisse')->name('GCSD');

	//////////////////////////////////** FIN **/////////////////////////////////////////////////////////////////	

	//////////////////////////////////** DOSSIERs **/////////////////////////////////////////////////////////////////
	Route::post('/dossiers', 'App\Http\Controllers\GestionnaireController@setdos')->name('GMDOS');
	Route::post('/modifier-dossiers', 'App\Http\Controllers\GestionnaireController@setmdos')->name('SUDOS');
	Route::get('/modifier-dossiers', 'App\Http\Controllers\GestionnaireController@getmdos')->name('UDOS'); // id
	Route::get('/supprimer-dossiers', 'App\Http\Controllers\GestionnaireController@deldos')->name('DDOS'); // id

	Route::get('/rencontre-dossiers', 'App\Http\Controllers\GestionnaireController@getrencontredos')->name('RDOS'); // id
	Route::post('/rencontre', 'App\Http\Controllers\GestionnaireController@setrencontredos')->name('SRDV');
	Route::post('/supprimer-rencontre', 'App\Http\Controllers\GestionnaireController@delrencontre')->name('DRCT');

	Route::get('/tresorerie-dossiers', 'App\Http\Controllers\GestionnaireController@gettresoreriedos')->name('TDOS'); // id
	Route::post('/tresorerie', 'App\Http\Controllers\GestionnaireController@settresoreriedos')->name('STDV');
	Route::post('/supprimer-dossiers', 'App\Http\Controllers\GestionnaireController@deltresor')->name('DTDV');

	Route::post('/affectation', 'App\Http\Controllers\GestionnaireController@affectUserInPoste')->name('PAOU');
	Route::post('/reaffectation', 'App\Http\Controllers\GestionnaireController@reaffecteruser')->name('RAOU');

	///////////////////////////////////** Utilisateur **///////////////////////////////////////////////////////////

	Route::get('/dashboard', 'App\Http\Controllers\GestionnaireController@dash')->name('dashboard');
	Route::get('/utilisateur', 'App\Http\Controllers\UtilisateurController@getuser')->name('GU');
	Route::post('/utilisateur', 'App\Http\Controllers\UtilisateurController@adduser')->name('setuser');
	Route::get('/delete-utilisateur-{id}', 'App\Http\Controllers\UtilisateurController@deleteuser')->name('DU');
	Route::get('/reinitialiser-utilisateur-{id}', 'App\Http\Controllers\UtilisateurController@reinitialiseruser')->name('RU');
	Route::get('/desactivé-utilisateur-{id}', 'App\Http\Controllers\UtilisateurController@desactiveuser')->name('DSU');
	Route::get('/activé-utilisateur-{id}', 'App\Http\Controllers\UtilisateurController@activeuser')->name('ATU');
	Route::get('/modif-utilisateur-{id}', 'App\Http\Controllers\UtilisateurController@getmodifyuser')->name('MTU');
	Route::post('/modif-utilisateur', 'App\Http\Controllers\UtilisateurController@modifyuser')->name('MTUS');
	Route::get('/getallusers', 'App\Http\Controllers\GestionnaireController@getalluserssys')->name('GAUS');

	//////////////////////////////////** Rôle **/////////////////////////////////////////////////////////////////
	Route::get('/listroles', 'App\Http\Controllers\RoleController@listrole')->name('GR');
	Route::post('/roles', 'App\Http\Controllers\RoleController@addrole')->name('AR');
	Route::get('/modif-roles-{id}', 'App\Http\Controllers\RoleController@getmodifrole')->name('MTR');
	Route::get('/delete-roles-{id}', 'App\Http\Controllers\RoleController@deleterole')->name('DR');
	Route::get('/menu-roles-{id}', 'App\Http\Controllers\RoleController@getmenurole')->name('MRR');
	Route::post('/menu-roles', 'App\Http\Controllers\RoleController@setmenurole')->name('MenuAttr');
	Route::post('/modif-roles', 'App\Http\Controllers\RoleController@modifrole')->name('SRL');


	//////////////////////////////////** Menu **/////////////////////////////////////////////////////////////////
	Route::get('/listmenus', 'App\Http\Controllers\MenuController@getmenu')->name('GM');
	Route::post('/listmenus', 'App\Http\Controllers\MenuController@setmenu')->name('Menu_add');
	Route::get('/delete-menu-{id}', 'App\Http\Controllers\MenuController@delmenu')->name('DM');
	Route::get('/modif-menu-{id}', 'App\Http\Controllers\MenuController@getmodifmenu')->name('MTM');
	Route::post('/modif-menu', 'App\Http\Controllers\MenuController@setmodifmenu')->name('SML');
	Route::post('/action-menu', 'App\Http\Controllers\MenuController@setactionmenu')->name('Actionsave');
	Route::get('/action-menu-{id}', 'App\Http\Controllers\MenuController@getactionmenu')->name('ActionGet');

	///////////////////////////////////** front-end **///////////////////////////////////////////////////////////

	Route::get('/dashfront', 'App\Http\Controllers\PageController@dashfront')->name('sev');
	Route::get('contacts/{id}/edit', 'App\Http\Controllers\PageController@edit')->name('contacts.edit');
	Route::put('contacts/{id}', 'App\Http\Controllers\PageController@update')->name('contacts.update');
	Route::post('team', 'App\Http\Controllers\PageController@store')->name('team.store');
	Route::get('team/{id}/edit', 'App\Http\Controllers\PageController@ditte')->name('team.edit');
	Route::put('team/{id}', 'App\Http\Controllers\PageController@tupdate')->name('team.update');
	Route::delete('team/{id}', 'App\Http\Controllers\PageController@destroy')->name('team.destroy');
	///////////////////////////////////** share file **///////////////////////////////////////////////////////////

	Route::get('/share', 'App\Http\Controllers\ShareController@file')->name('file');
	Route::patch('/update/{id}', 'App\Http\Controllers\ServiceController@update')->name('update'); // Met à jour un service

	Route::post('/store', 'App\Http\Controllers\TestimonialController@store')->name('testimonials.store'); // Ajoute un nouveau témoignage
	Route::get('/edit/{id}', 'App\Http\Controllers\TestimonialController@edit')->name('testimonials.edit'); // Affiche un témoignage pour modification
	Route::post('/update/{id}', 'App\Http\Controllers\TestimonialController@update')->name('testimonials.update'); // Met à jour un témoignage
	Route::delete('/delete/{id}', 'App\Http\Controllers\TestimonialController@destroy')->name('testimonials.destroy'); // Supprime un témoignage

});
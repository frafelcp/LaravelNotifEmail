<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('enviar', ['as' => 'enviar', function(){
	$data = ['link' => 'http://compuzoft.com'];
	\Mail::send('emails.notificacion', $data, function($message){
		$message->from('email@compuzoft.com', 'Compuzoft');
		$message->to('user@example.com')->subject('Notificacio');
	});
	return "Se envio el email";
}]);

Route::get('sends', function(){
	\Mail::send('emails.email', [], function($message){
		$message->from('admin@compuzoft.com', 'Felix Castro');
		$message->to('user@example.com')->subject('Bienvenido');
	});
	return "Se envio el email correctamente";
});

Route::get('sendall', function(){
	$users = \App\User::all();
	foreach ($users as $user) {
		\Mail::send('emails.email', [], function($message) use ($user){
			$message->from('admin@compuzoft.com', 'Felix Castro');
			$message->to($user->email, $user->name)->subject('Bienvenido ' . $user->name);
		});
		return "Se envio el email correctamente";
	}
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

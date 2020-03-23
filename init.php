<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Config.php';
require_once 'classes/Validate.php';
require_once 'classes/Input.php';
require_once 'classes/Token.php';
require_once 'classes/Session.php';
require_once 'classes/User.php';
require_once 'classes/Redirect.php';
require_once 'classes/Cookie.php';


//Redirect::to(404);

//Database::getInstance()->query('SELECT * FROM users');
//$users = Database::getInstance()->query("SELECT * FROM users WHERE username = ?", ['john']);
//$users = Database::getInstance()->query("SELECT * FROM users WHERE username IN (?, ?)", ['john', 'jane']);
//$users = Database::getInstance()->get('users', ['username', '=', 'john']);
//$users = Database::getInstance()->delete('users', ['username', '=', 'jane']);

//$users = Database::getInstance()->get('users', ['username', '=', 'john']);

//echo $users->results()[0]->username;
//echo $users->first()->username;

/*
$users = Database::getInstance()->insert('users', [
	'username' => 'john',
	'password' => '123'
]);
*/


/*
$id = 1;
$users = Database::getInstance()->update('users', $id, [
	'username' => 'jane',
	'password' => '123'
]);
*/

//var_dump($users->count()); die;


/*
if($users->error()) {
	echo 'we have an error';
} else {
	foreach($users->results() as $user) {
		echo $user->username . '<br>';
	}
}

*/

$GLOBALS['config'] = [
	'mysql' => [
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'database' => 'test'
	],
	
	'session' => [
		'token_name' => 'token',
		'user_session' => 'user'
	],
	
	'cookie' => [
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800 // неделя
	]
];

// echo Config::get('mysql.host');

// $users = Database::getInstance()->query('select * from users');
//var_dump($users->results());


if(Cookie::exists(Config::get('cookie.cookie_name')) && !Session::exists(Config::get('session.user_session'))) {
	$hash = Cookie::get(Config::get('cookie.cookie_name'));	
	$hashCheck = Database::getInstance()->get('user_sessions', ['hash', '=', $hash]);		
	
	//var_dump($hashCheck->first()->user_id); die; // 5
	
	if($hashCheck->count()) {		
		$user = new User($hashCheck->first()->user_id); // было
		$user->login(); // автоматом вызываем логин без паролей 
		
		
		
		//$user = new User;
		//$user->find($hashCheck->first()->user_id);
		//$user->login(); // автоматом вызываем логин без паролей
	
	}
}


?>
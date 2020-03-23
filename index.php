<?php
require_once 'init.php';

//var_dump(Config::get('session.user_session'));
echo Session::flash('success');

$user = new User;
$anotherUser = new User(1);

if($user->isLoggedIn()) {
	echo "Hi, <a href='#'>{$user->data()->username}</a>";
	echo "<p><a href='logout.php'>Logout</a></p>";
	echo "<p><a href='update.php'>Update</a></p>";
	echo "<p><a href='changepassword.php'>Change password</a></p>";
	
	if($user->hasPermissions('admin')) {
		echo 'You are admin!';
	}
	
} else {
	echo "<p><a href='login.php'>Login</a> or <a href='register.php'>Register</a></p>";
}




/*

if($user->isLoggedIn()) {
	
} else {
	
}
*/


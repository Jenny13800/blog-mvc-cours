<?php 

//require_once('libraries/database.php');
require_once("libraries/controllers/Controller.php");

class UsersController extends Controller {

	protected $viewFolder = 'users';

	public function loginForm(){
		$this->display('login');
	}

	public function registerForm(){
		$this->display('register'); 
	}

}

?>
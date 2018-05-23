<?php

	session_start();
	require_once('init.php');
	/*require_once('User.class.php');*/
	
	$session = new User();
	
	
	if(!$session->is_loggedin())
	{
		
		$session->redirect('index.php');
	}
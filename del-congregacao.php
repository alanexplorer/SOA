<?php
	require_once("session.php");
	require_once('init.php');
	
	$user = new Congregation();
	
	$stmt = $user->runQuery("DELETE FROM congregation WHERE ID = '".$_GET['id']."'");
	$stmt->execute();
	echo "<script language=javascript>parent.location.href='congregacao-editar.php';</script>";

?>
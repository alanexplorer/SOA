<?php
	require_once("session.php");
	require_once('init.php');
	
	$user = new Obreiro();
	
	$stmt = $user->runQuery("DELETE FROM obreiro WHERE ID = '".$_GET['id']."'");
	$stmt->execute();
	echo "<script language=javascript>parent.location.href='obreiro-editar.php';</script>";

?>
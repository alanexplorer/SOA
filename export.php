 <?php
 
 	require_once("session.php");
    require_once('init.php');
    
	$auth_user = new User();
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	
	$congre = new Congregation;
	$sql = $congre->runQuery("SELECT id, con_name, con_lider, con_adress FROM congregation ORDER BY ID DESC");
	$sql->execute(array(':con_name'=>$con_name, ':con_lider'=>$con_lider, ':con_adress'=>$con_adress));
	
	
	$columnHeader = '';
	$columnHeader = "#" . "\t" ."Congregação" . "\t" . "Dirigente" . "\t" . "Endereço" . "\t";
	$setData = '';
	while ($row =$sql->fetch(PDO::FETCH_ASSOC)) {
	$rowData = '';
	foreach ($row as $value) {
	$value = '"' . $value . '"' . "\t";
	$rowData .= $value;
	}
	$setData .= trim($rowData) . "\n";
	}
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=igrejas.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($columnHeader) . "\n" . $setData . "\n";
?> 
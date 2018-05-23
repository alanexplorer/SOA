 <?php
 
 	require_once("session.php");
    require_once('init.php');
    
	$auth_user = new User();
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	
	$congre = new Obreiro;
	$sql = $congre->runQuery("SELECT ID, Nome, CPF, Telefone FROM obreiro ORDER BY ID ASC");
	$sql->execute(array(':Nome'=>$Nome, ':CPF'=>$CPF, ':Telefone'=>$Telefone));
	
	
	$columnHeader = '';
	$columnHeader = "#" . "\t" ."Nome" . "\t" . "CPF" . "\t" . "Telefone" . "\t";
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
	header("Content-Disposition: attachment; filename=obreiros.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($columnHeader) . "\n" . $setData . "\n";
?> 
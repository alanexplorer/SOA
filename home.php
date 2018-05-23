<?php

	require_once("session.php");
	require_once('init.php');
	/*require_once('User.class.php');*/
	
	$auth_user = new User();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
?>

<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/Bootstrap.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<script type="text/javascript">
	window.apex_search = {};
	apex_search.init = function (){
		this.rows = document.getElementById('data').getElementsByTagName('TR');
		this.rows_length = apex_search.rows.length;
		this.rows_text =  [];
		for (var i=0;i<apex_search.rows_length;i++){
			this.rows_text[i] = (apex_search.rows[i].innerText)?apex_search.rows[i].innerText.toUpperCase():apex_search.rows[i].textContent.toUpperCase();
		}
		this.time = false;
	}
	apex_search.lsearch = function(){
		this.term = document.getElementById('S').value.toUpperCase();
		for(var i=0,row;row = this.rows[i],row_text = this.rows_text[i];i++){
			row.style.display = ((row_text.indexOf(this.term) != -1) || this.term  === '')?'':'none';
		}
		this.time = false;
	}
	apex_search.search = function(e){
		var keycode;
		if(window.event){keycode = window.event.keyCode;}
		else if (e){keycode = e.which;}
		else {return false;}
		if(keycode == 13) { apex_search.lsearch(); } else { return false; }
	}
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/navbar.css"/>
<link rel="stylesheet" type="text/css" href="content/fontawesome-all.min.css">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Avivamento da Fé</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body class="badge-light" onload="apex_search.init();" >
	<div class="container">
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
   		<a class="navbar-brand" href="#"><?php print($userRow['user_name']); ?> |</a>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls=		"navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        	<span class="navbar-toggler-icon"></span>
      		</button>
		  <div class="collapse navbar-collapse" id="navbarsExample01">
       		<ul class="navbar-nav mr-auto">
                	<li class="nav-item active">
            			<a class="nav-link" href="home.php">Inicio</a>
          			</li>
                	<li class="nav-item dropdown nav-item">
            			<a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Obreiros  <span class="sr-only">(current)</a>
            			<div class="dropdown-menu" aria-labelledby="dropdown01">
                          <a class="dropdown-item" href="obreiro-cadastro.php">Cadastrar</a>
                          <a class="dropdown-item" href="obreiro-editar.php">Editar</a>
            			</div>
          			</li>
                    <li class="nav-item dropdown nav-item">
            			<a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Congregação </a>
            			<div class="dropdown-menu" aria-labelledby="dropdown01">
                          <a class="dropdown-item" href="congregacao-cadastro.php">Cadastrar</a>
                          <a class="dropdown-item" href="congregacao-editar.php">Editar</a>
            			</div>
          			</li>
                    <li class="nav-item dropdown nav-item">
            			<a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Serviço</a>
            			<div class="dropdown-menu" aria-labelledby="dropdown01">
                        	<a class="dropdown-item" href="relatorio.php">Relatório</a>
                          <a class="dropdown-item disabled" href="carta-1.php">Carta de Apresentação</a>
                           <a class="dropdown-item disabled" href="carta-2.php">Carta de Mudança</a>
                          <a class="dropdown-item disabled" href="ficha.php">Ficha de Obreiro</a>
                          <a class="dropdown-item disabled" href="convite.php">Convite</a>
                          <a class="dropdown-item " href="usuario-cadastro.php">Usuário</a>
            			</div>
          			</li>
                    <li class="nav-item">
            			<a class="nav-link" href="logout.php?logout=true">Sair</a>
          			</li>
       		  </ul>
   		    </div>
   		 </nav>
         
		 <!-- InstanceBeginEditable name="EditRegion" -->
                
                 <div class="row">
                 <div class="jumbotron">
                      <h1 class="display-4">Bem Vindo!</h1>
                      <p class="lead">Este é um sistema para cadastro de obreiro da Igreja Evangélica Avivamento da Fé, nosso objetivo é informatizar nossas informações. O sistema de cadastro pode ser utilizado em qualquer plataforma desde celulares até computadores convencionais. Além da função de cadastro e gerenciamento de dados pessoais, oferecemos alguns serviços essenciais para igrejas, como: Carta de Apresentação, Carda de Mudança, Convite e uma ficha personalizada do obreiro, além de relatórios e consultas de dados.</p>
                      <hr class="my-4">
                      <p>Para mais informalçao de como utilizar o sistema, click no botão abaixo.</p>
                      <p class="lead">
                        <a class="btn btn-primary btn-lg" href="#" role="button">Tutorial</a>
                      </p>
                    </div>
                  </div>
		 <!-- InstanceEndEditable -->
       
         <footer class="my-5 pt-5 container">
		   <p class="mb-1">&copy; 2017-2018 Igreja Evangélica Avivamento da Fé</p>
      	</footer>
    </div>
<!--jQuery first, then Popper.js, them Bootstrap.js -->
<script type="text/javascript" src="bootstrap/js/jquery-3.2.1.slim.js"></script>
<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
<!-- InstanceEnd --></html>

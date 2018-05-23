<?php

	require_once("session.php");
	require_once('init.php');
	
	$user = new User();
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  if(isset($_POST['btn-signup']))
	{
		$uname = strip_tags($_POST['txt_uname']);
		$umail = strip_tags($_POST['txt_umail']);
		$upass = strip_tags($_POST['txt_upass']);	
		
		if($uname=="")	{
			$error[] = "Escolha um nome de usuário !";	
		}
		else if($umail=="")	{
			$error[] = "Escolha um email !";	
		}
		else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
			$error[] = 'Seu email não é válido !';
		}
		else if($upass=="")	{
			$error[] = "Escolha uma senha !";
		}
		else if(strlen($upass) < 6){
			$error[] = "A senha deve ser maior que 6 caracter";	
		}
		else
		{
			try
			{
				$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
				$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
					
				if($row['user_name']==$uname) {
					$error[] = "Esse nome de usuário ja existe!";
				}
				else if($row['user_email']==$umail) {
					$error[] = "Esse email já existe!";
				}
				else
				{
					if($user->register($uname,$umail,$upass)){	
						$user->redirect('usuario-cadastro.php?joined');
					}
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}	
	}
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
			<div class="py-5 text-center">
        		<h2>Cadastro de Usuário</h2>
        		<p class="lead">Prenchar o formulário abaixo corretamente para cadastrar um usuário.</p>
      		</div>
          <form class="needs-validation" novalidate method="post">
          <!-- form line 1 -->
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="txt_uname">Login</label>
                            <input type="text" class="form-control" id="txt_uname" value="" required name="txt_uname">
                            <div class="invalid-feedback">
                                Diga o nome do usuário!
                            </div>
                        </div>
                    <div class="col-md-5 mb-3">
                      		<label for="txt_umail">Email</label>
                      		<input type="text" class="form-control" id="txt_umail" value="" required name="txt_umail">
                      		<div class="invalid-feedback">
                        		Escolha um senha!
                      		</div>
                    </div>
                     <div class="col-md-3 mb-3">
                      		<label for="txt_upass">Senha</label>
                      		<input type="password" class="form-control" id="txt_upass" value="" required name="txt_upass">
                      <div class="invalid-feedback">
                        Prenchar esse campo!
                      	</div>
                    </div>
                  </div>
            <!-- fim form line 1 -->
                  <button class="btn btn-primary" type="submit" name="btn-signup">Cadastrar</button>
                   <?php
						if(isset($error))
						{
							foreach($error as $error)
							{
								 ?>
								 <div class="alert alert-danger">
									<i class="fa fa-exclamation-circle"></i> &nbsp; <?php echo $error; ?>
								 </div>
								 <?php
							}
						}
						else if(isset($_GET['joined']))
						{
							 ?>
							 <div class="alert alert-info">
								  <i class="fa fa-thumbs-up"></i> &nbsp; Usuário cadastrado !
							 </div>
							 <?php
						}
                    ?>
                </form>
                <script>
				// Example starter JavaScript for disabling form submissions if there are invalid fields
				(function() {
				  'use strict';
				  window.addEventListener('load', function() {
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					var forms = document.getElementsByClassName('needs-validation');
					// Loop over them and prevent submission
					var validation = Array.prototype.filter.call(forms, function(form) {
					  form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
						  event.preventDefault();
						  event.stopPropagation();
						}
						form.classList.add('was-validated');
					  }, false);
					});
				  }, false);
				})();
				</script>
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

<?php

	require_once("session.php");
	require_once('init.php');
	
	$user = new Congregation();
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $user->runQuery("SELECT id, con_name, con_lider, con_adress FROM congregation WHERE id = '".$_GET['id']."'");
	$stmt->execute(array(':con_name'=>$con_name, ':con_lider'=>$con_lider, ':con_adress'=>$con_adress));
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    
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
        		<h2>Cadastro de Congregação</h2>
        		<p class="lead">Prenchar o formulário abaixo corretamente para cadastrar uma congregação.</p>
      		</div>
          <form class="needs-validation" novalidate method="post">
          <?php  
			if(isset($_POST['update']))
			{
				$stmt = $user->runQuery("UPDATE congregation SET con_name = '".$_POST['txt_congre']."', con_lider = '".$_POST['txt_lider']."', con_adress = '".$_POST['txt_adress']."' WHERE id = '".$_GET['id']."'");
				$stmt->execute();
				
				$success = "sucesso";
				
				//Re-Load Data from DB
				
				$stmt = $user->runQuery("SELECT id, con_name, con_lider, con_adress FROM congregation WHERE id = '".$_GET['id']."'");
				$stmt->execute(array(':con_name'=>$con_name, ':con_lider'=>$con_lider, ':con_adress'=>$con_adress));
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
			}
		  ?>
          <!-- form line 1 -->
                    <div class="form-row">
                        <div class="col-sm-3 mb-3">
                            <label for="txt_congre">Congregação</label>
                            <input type="text" class="form-control" id="txt_congre" value="<?php echo $row['con_name']; ?>" required name="txt_congre">
                            <div class="invalid-feedback">
                                Digite o nome da congregação!
                            </div>
                        </div>
                    <div class="col-sm-4 mb-3">
                      		<label for="txt_lider">Dirigente</label>
                      		<input type="text" class="form-control" id="txt_lider" value="<?php echo $row['con_lider']; ?>" required name="txt_lider">
                      		<div class="invalid-feedback">
                        		Digite o nome do dirigente!
                      		</div>
                    </div>
                     <div class="col-sm-5 mb-3">
                      		<label for="txt_adress">Endereço</label>
                      		<input type="text" class="form-control" id="txt_adress" value="<?php echo $row['con_adress']; ?>" required name="txt_adress">
                      <div class="invalid-feedback">
                        Digite o endereço!
                      	</div>
                    </div>
                  </div>
            <!-- fim form line 1 -->
                  <button class="btn btn-primary" type="submit" name="update"><i class="fa fa-upload"></i> Atualizar</button>
                  <a href="congregacao-editar.php" class="btn btn-danger"><i class="fa fa-ban"></i> Cancelar</a>
                  
                   <?php
                    if(isset($success))
                    {
		 				 echo '<div class="alert alert-success">Dados atualizados</div>';
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

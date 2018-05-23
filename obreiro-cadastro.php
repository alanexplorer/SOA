<?php

	require_once("session.php");
	require_once('init.php');
	
	$user_id = $_SESSION['user_session'];
	
	$congre = new Congregation;
	$sql = $congre->runQuery("SELECT id, con_name, con_lider, con_adress FROM congregation ORDER BY ID DESC");
	$sql->execute(array(':con_name'=>$con_name, ':con_lider'=>$con_lider, ':con_adress'=>$con_adress));
	
	$user = new Obreiro();
	$stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  
	    
    if(isset($_POST['cadastrar']))
    {
		$uCongregacao  = strip_tags($_POST['txt_congregacao']);
		$uNome  = strip_tags($_POST['txt_nome']);
		$uNascimento = strip_tags($_POST['txt_nascimento']);
		$uRG  = strip_tags($_POST['txt_rg']);
		$uCPF  = strip_tags($_POST['txt_cpf']);
		$uPai  = strip_tags($_POST['txt_pai']);
		$uMae = strip_tags($_POST['txt_mae']);
		$uNacionalidade = strip_tags($_POST['txt_nacionalidade']);
		$uNaturalidade  = strip_tags($_POST['txt_naturalidade']);
		$uEstado = strip_tags($_POST['txt_estado']);
		$uTelefone  = strip_tags($_POST['txt_telefone']);
		$uProfissao  = strip_tags($_POST['txt_profissao']);
		$uEndereco  = strip_tags($_POST['txt_endereco']);
		$uNumero  = strip_tags((int)$_POST['txt_numero']);
		$uBairro  = strip_tags($_POST['txt_bairro']);
		$uCidade  = strip_tags($_POST['txt_cidade']);
		$uCep  = strip_tags($_POST['txt_cep']);
		$uEstado_Civil  = strip_tags($_POST['txt_civil']);
		$uNome_do_Conjuge = strip_tags($_POST['txt_conjuge']);
		$uCPF_do_Conjuge  = strip_tags($_POST['txt_cpf-conjuge']);
		$uNumero_de_Filhos = strip_tags((int)$_POST['txt_numero-filhos']);
		$uFuncao_Ministerial  = strip_tags($_POST['txt_funcao']);
		$uDesde = strip_tags($_POST['txt_desde']);
		$uIgreja  = strip_tags($_POST['txt_congregacao']);
       
		try
		{
			$stmt = $user->runQuery("SELECT CPF FROM obreiro WHERE CPF=:uCPF");
			$stmt->execute(array(':uCPF'=>$uCPF));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['CPF']==$uCPF) {
				$error[] = "Esse obreiro ja foi cadastrado";
			}
			else
			{
				if($user->register($uCongregacao, $uNome, $uNascimento, $uRG, $uCPF, $uPai, $uMae, $uNacionalidade, $uNaturalidade, $uEstado, $uTelefone, $uProfissao, $uEndereco, $uNumero, $uBairro, $uCidade, $uCep, $uEstado_Civil, $uNome_do_Conjuge, $uCPF_do_Conjuge,	$uNumero_de_Filhos, $uFuncao_Ministerial, $uDesde, $uIgreja)){	
					$user->redirect('obreiro-cadastro.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
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
        		<h2>Cadastro de Obreiro</h2>
        		<p class="lead">Prenchar o formulário abaixo corretamente para cadastrar o obreiro.</p>
      		</div>
          <form class="needs-validation" novalidate method="post">
          <!-- form line 1 -->
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <label for="txt_nome">Nome</label>
                            <input type="text" class="form-control" id="txt_nome" value="" required name="txt_nome">
                            <div class="invalid-feedback">
                                Preencha o campo nome!
                            </div>
                        </div>
                    <div class="col-sm-3 mb-3">
                      		<label for="txt_cpf">CPF</label>
                      		<input type="text" class="form-control" id="txt_cpf" value="" required name="txt_cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                      <div class="invalid-feedback">
                        Preencha o campo CPF no formato xxx.xxx.xxx-xx!
                      	</div>
                    </div>
                     <div class="col-sm-3 mb-3">
                      		<label for="txt_rg">RG</label>
                      		<input type="text" class="form-control" id="txt_rg" value="" required name="txt_rg">
                      <div class="invalid-feedback">
                        Preencha o campo RG!
                      	</div>
                    </div>
                  </div>
            <!-- fim form line 1 -->
            <!-- form line 2 -->
                    <div class="form-row">
                        <div class="col-sm-3 mb-3">
                            <label for="txt_nascimento">Data de nascimento</label>
                            <input type="text" class="form-control" id="txt_nascimento" value="" required name="txt_nascimento" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}">
                            <div class="invalid-feedback">
                                Preencha o campo data de nascimento no formato dd-mm-aa!
                            </div>
                        </div>
                    <div class="col-sm-4 mb-3">
                      		<label for="txt_nacionalidade">Nacionalidade</label>
                      		<input type="text" class="form-control" id="txt_nacionalidade" value="" required name="txt_nacionalidade">
                      <div class="invalid-feedback">
                        Preencha o campo Nacionalidade!
                      	</div>
                    </div>
                     <div class="col-sm-5 mb-3">
                      		 <label for="txt_naturalidade">Naturalidade</label>
                      		<select class="custom-select d-block w-100" id="txt_naturalidade" required name="txt_naturalidade">
                        		<option value="">Escolha...</option>
                        		<option>Estrangeiro</option>
                                <option>Acre</option>
                                <option>Alagoas</option>
                                <option>Amapá</option>
                                <option>Amazonas</option>
                                <option>Bahia</option>
                                <option>Ceará</option>
                                <option>Distrito Federal</option>
                                <option>Espirito Santo</option>
                                <option>Goiás</option>
                                <option>Maranhã</option>
                                <option>Mato Grosso</option>
                                <option>Mato Grosso do Sul</option>
                                <option>Minas Gerais</option>
                                <option>Pará</option>
                                <option>Paraíba</option>
                                <option>Paraná</option>
                                <option>Pernambuco</option>
                                <option>Piauí</option>
                                <option>Rio de Janeiro</option>
                                <option>Rio Grande do Norte</option>
                                <option>Rio Grandedo Sul</option>
                                <option>Rondônia</option>
                                <option>Roraima</option>
                                <option>Santa Catarina</option>
                                <option>São Paulo</option>
                                <option>Sergipe</option>
                                <option>Tocantis</option>
                      		</select>
                       <div class="invalid-feedback">
                           Preencha o campo Naturalidade!
                       </div>
                    </div>
                  </div>
                  <hr>
            <!-- fim form line 2 -->
            <!-- form line 3 -->
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <label for="txt_endereco">Endereço</label>
                            <input type="text" class="form-control" id="txt_endereco" placeholder="Rua Santa Luzia" value="" required name="txt_endereco">
                            <div class="invalid-feedback">
                                Preencha o campo Endereço!
                            </div>
                        </div>
                    <div class="col-sm-1 mb-3">
                      		<label for="txt_numero">Nº</label>
                      		<input type="text" class="form-control" id="txt_numero" value="" required name="txt_numero">
                      <div class="invalid-feedback">
                        Preencha o campo Número!
                      	</div>
                    </div>
                     <div class="col-sm-5 mb-3">
                      		<label for="txt_bairro">Bairro</label>
                      		<input type="text" class="form-control" id="txt_bairro" value="" required name="txt_bairro">
                      <div class="invalid-feedback">
                        Preencha o campo Bairro!
                      	</div>
                    </div>
                  </div>
            <!-- fim form line 3 -->
             <!-- form line 4 -->
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <label for="txt_cidade">Cidade</label>
                            <input type="text" class="form-control" id="txt_cidade" value="" required name="txt_cidade">
                            <div class="invalid-feedback">
                                Preencha o campo Cidade!
                            </div>
                        </div>
                    <div class="col-sm-5 mb-3">
                      		<label for="txt_estado">Estado</label>
                      		<select class="custom-select d-block w-100" id="txt_estado" required name="txt_estado">
                        		<option value="">Escolha...</option>
                                <option>Acre</option>
                                <option>Alagoas</option>
                                <option>Amapá</option>
                                <option>Amazonas</option>
                                <option>Bahia</option>
                                <option>Ceará</option>
                                <option>Distrito Federal</option>
                                <option>Espirito Santo</option>
                                <option>Goiás</option>
                                <option>Maranhã</option>
                                <option>Mato Grosso</option>
                                <option>Mato Grosso do Sul</option>
                                <option>Minas Gerais</option>
                                <option>Pará</option>
                                <option>Paraíba</option>
                                <option>Paraná</option>
                                <option>Pernambuco</option>
                                <option>Piauí</option>
                                <option>Rio de Janeiro</option>
                                <option>Rio Grande do Norte</option>
                                <option>Rio Grandedo Sul</option>
                                <option>Rondônia</option>
                                <option>Roraima</option>
                                <option>Santa Catarina</option>
                                <option>São Paulo</option>
                                <option>Sergipe</option>
                                <option>Tocantis</option>
                      		</select>
                       <div class="invalid-feedback">
                           Preencha o campo Estado!
                       </div>
                    </div>
                     <div class="col-sm-3 mb-3">
                      		<label for="txt_cep">CEP</label>
                      		<input type="text" class="form-control" id="txt_cep" value="" required name="txt_cep" pattern="[0-9]{5}-[0-9]{3}">
                      <div class="invalid-feedback">
                        Preencha o campo CEP no formato "00000-000"!
                      	</div>
                    </div>
                  </div>
                  <hr>
            <!-- fim form line 4 -->
            <!-- form line 5 -->
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <label for="txt_telefone">Telefone</label>
                            <input type="text" class="form-control" id="txt_telefone" value="" required name="txt_telefone">
                            <div class="invalid-feedback">
                                Preencha o campo Telefone!
                            </div>
                        </div>
                    <div class="col-sm-4 mb-3">
                      		<label for="txt_profissao">Profissão</label>
                      		<input type="text" class="form-control" id="txt_profissao" value="" required name="txt_profissao">
                      <div class="invalid-feedback">
                        Preencha o campo Profisão!
                      </div>
                    </div>
                     <div class="col-sm-4 mb-3">
                      		<label for="txt_congregacao">Congregação</label>
                      		<select class="custom-select d-block w-100" id="txt_congregacao" required name="txt_congregacao">
                                <option value="">Escolha...</option>
                                <?php while ($row =$sql->fetch(PDO::FETCH_ASSOC)):;?>
                                <option><?php echo $row['con_name'];?></option>
                                <?php endwhile ?>
                            </select>
                      <div class="invalid-feedback">
                        Preencha o campo Congregação!
                      	</div>
                    </div>
                  </div>
            <!-- fim form line 5 -->
             <!-- form line 6 -->
                    <div class="form-row">
                        <div class="col-sm-5 mb-3">
                            <label for="txt_pai">Nome do Pai</label>
                            <input type="text" class="form-control" id="txt_pai" value="" required name="txt_pai">
                            <div class="invalid-feedback">
                                Preencha o campo Pai!
                            </div>
                        </div>
                    <div class="col-sm-5 mb-3">
                      		<label for="txt_mae">Nome da Mãe</label>
                      		<input type="text" class="form-control" id="txt_mae" value="" required name="txt_mae">
                      <div class="invalid-feedback">
                        Preencha o campo Mãe!
                      	</div>
                    </div>
                    <div class="col-sm-2 mb-3">
                      		<label for="txt_civil">Estado Civil</label>
                      		<select class="custom-select d-block w-100" id="txt_civil" required name="txt_civil">
                                <option value="">Escolha...</option>
                                <option>Solteiro(a)</option>
                                <option>Casado(a)</option>
                                <option>Divorciado(a)</option>
                                <option>Viuvo(a)</option>
                            </select>
                      <div class="invalid-feedback">
                        Preencha o campo estado cívil!
                      	</div>
                    </div>
                  </div>
            <!-- fim form line 6 -->
            <!-- form line 7 -->
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <label for="txt_conjuge">Nome do Conjuge</label>
                            <input type="text" class="form-control" id="txt_conjuge" value="" name="txt_conjuge">
                            <div class="invalid-feedback">
                                Preencha o campo Nome do Conjuge!
                            </div>
                        </div>
                    <div class="col-sm-3 mb-3">
                      		<label for="txt_cpf-conjuge">CPF do Conjuge</label>
                      		<input type="text" class="form-control" id="txt_cpf-conjuge" value="" name="txt_cpf-conjuge" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                      <div class="invalid-feedback">
                        Preencha o campo CPF do Conjuge no formato xxx.xxx.xxx-xx!
                      	</div>
                    </div>
                     <div class="col-sm-3 mb-3">
                      		<label for="txt_numero-filhos">Número de Filhos</label>
                      		<input type="number" class="form-control" id="txt_numero-filhos" value="" name="txt_numero-filhos">
                      <div class="invalid-feedback">
                        Preencha o campo Número de Filhos!
                      	</div>
                    </div>
                  </div>
                  <hr>
            <!-- fim form line 7 -->
             <!-- form line 8 -->
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <label for="txt_funcao">Função Ministérial</label>
                            <select class="custom-select d-block w-100" id="txt_funcao" required name="txt_funcao">
                                <option value="">Escolha...</option>
                                <option>Obreiro</option>
                                <option>Obreira</option>
                                <option>Cooperador</option>
                                <option>Diácono</option>
                                <option>Diaconisa</option>
                                <option>Evangelista</option>
                                <option>Missionário</option>
                                <option>Missionária</option>
                                <option>Presbitero</option>
                                <option>Pastor</option>
                            </select>
                            <div class="invalid-feedback">
                                Preencha o campo Função Ministérial!
                            </div>
                        </div>
                    <div class="col-sm-3 mb-3">
                      		<label for="txt_desde">Desde</label>
                      		<input type="text" class="form-control" id="txt_desde" value="" required name="txt_desde" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}">
                      <div class="invalid-feedback">
                        Preencha a data que você ungido no formato dd-mm-aa!
                      	</div>
                    </div>
                  </div>
            <!-- fim form line 8 -->          
                  <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
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
                              <i class="fa fa-thumbs-up"></i> &nbsp; Obreiro cadastrado !
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
				</script>		 <!-- InstanceEndEditable -->
       
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

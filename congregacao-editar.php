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
            <div class="col-sm-4">
                <div class="input-group">
                <input type="text" size="30" class="form-control" maxlength="1000" value="" id="S" onkeyup="apex_search.search(event);" />
                <span class="input-group-btn">
                <input type="button" class="btn btn-default" value="Procurar" onclick="apex_search.lsearch();"/>
                </span>
                </div>
            </div>
            
            <div class="col-sm-4">
            <a href="export.php" class="btn btn-success"><span aria-hidden="true"></span><i class="fa fa-download"></i> Exportar para Excel</a>
            </div>
            </div>
            
            <br />
            
            <div class="row">
                <div class="col-md-12">
                <p>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th  scope="col"><center>#</center></th>
                                 <th  scope="col">Congregação</th>
                                 <th  scope="col">Dirigente</th>
                                 <th  scope="col">Endereço</th>
                                 <th  scope="col"><center>Ação</center></th>
                            </tr>
                        </thead>
                        <tbody id="data">
                        <?php $no=1; while ($row =$sql->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td align="center"><?php echo $no; ?></td>
                                <td><?php echo $row['con_name']; ?></td>
                                <td><?php echo $row['con_lider']; ?></td>
                                <td><?php echo $row['con_adress']; ?></td>
                                <td align="center">
                                <a href="edit-congregacao.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a> 
                                | 
                                <a href="del-congregacao.php?id=<?php echo $row['id']; ?>" onclick ="if (!confirm('Tem certeza que deseja excluir?')) return false;"><i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php $no++; } ?>	
                        </tbody>
                    </table>
                </p>	
                </div>
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

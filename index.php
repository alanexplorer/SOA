<?php
session_start();

require_once('init.php');

/*require_once('User.class.php');*/

$login = new User();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$success = "sucesso";
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/signin.css"/>
<title>Avivamento da Fé</title>
</head>
<body class="text-center">
 	
    <form class="form-signin" method="post">
    <img class="mb-4" src="img/logo_login.svg" width="133" height="120" />
      <label for="txt_uname_email" class="sr-only">Username or E mail ID</label>
      <input type="text" id="txt_uname_email" class="form-control" placeholder="Usuário" required autofocus name="txt_uname_email">
      <label for="txt_password" class="sr-only">Senha</label>
      <input type="password" id="txt_password" class="form-control" placeholder="Senha" required name="txt_password">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Lembre-me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-login">Entre</button>
      <?php
		if(isset($error)) {
		  echo '<div class="alert alert-danger">Dados de login incorretos</div>';
		}
		if(isset($success)) {
		  echo '<div class="alert alert-success">Logout efetuado com sucesso</div>';
		}
	  ?>        
      <p class="mt-5 mb-3 text-muted">Igreja Evangélica Avivamento da Fé &copy; 2017-2018</p>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script>
      setTimeout(function() {
        $('.alert').fadeOut();
      }, 3000);
    </script>
</body>
</html>
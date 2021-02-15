<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
	session_start();

			
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$nome='';
		$user_name='';
		$email='';
		$password='';

		if(isset($_POST['nome'])){

			$nome=$_POST['nome'];
		}
		else{
			echo '<script>alert("É obrigatorio o preenchimento do nome.");</script>';
		}
		if (isset($_POST['user_name'])) {
			$user_name=$_POST['user_name'];
		}
		if (isset($_POST['email'])) {
			$email=$_POST['email'];
		}
		if (isset($_POST['password'])) {
			$password=$_POST['password'];
			//$password_encriptada=password_hash($password, PASSWORD_DEFAULT);
			$password_encriptada=$password;
		}
		$con=new mysqli("localhost","root","","projetorc");

		if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
		}

		else{

			$sql="insert into utilizadores (nome, user_name,email,password)values(?,?,?,?)";
			$stm=$con->prepare($sql);
			if($stm!=false){

				$stm->bind_param('ssss',$nome,$user_name,$email,$password_encriptada);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Utilizador adicionado com sucesso");</script>';
				echo 'Aguarde um momento. A reencaminhar página';
				header("refresh:2;url=index.php");
			}
			else{
				echo ($con->error);
				echo 'Erro Aguarde um momento. A reencaminhar página';
				header("refresh:2;url=index.php");
			}
		}
	}
	else{
?>	
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Adicionar Utilizador</title>
	</head>
	<body>
		<h1>Adicionar Utilizadores</h1>	
		<form action="utilizador_create.php" method="post">
			<label>Nome</label><input type="text" name="nome" required><br>
			<label>user_name</label><input type="text" name="user_name"><br>
			<label>email</label><input type="text" name="email"><br>
			<label>password</label><input type="text" name="password"><br>
			<input type="submit" name="enviar">
		</form>
		<br>
		<a href="index.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  				<path fill-rule="evenodd" d="M6.603 2h7.08a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-7.08a1 1 0 0 1-.76-.35L1 8l4.844-5.65A1 1 0 0 1 6.603 2zm7.08-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zM5.829 5.146a.5.5 0 0 0 0 .708L7.976 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
			</svg>
		</a>
	</body>

	<script src="../js/jquery-3.5.1.min.js"></script>
			<script src="../js/bootstrap.js"></script>
			
	</html>
	<?php
	}

	
	?>

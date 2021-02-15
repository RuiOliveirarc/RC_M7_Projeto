<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
session_start();
if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {


	if($_SERVER['REQUEST_METHOD']=='POST'){
		$nome='';
		$data_nacimento='';
		$nacionalidade='';
		

		if(isset($_POST['nome'])){

			$nome=$_POST['nome'];
		}
		else{
			echo '<script>alert("É obrigutilizadorio o preenchimento do nome.");</script>';
		}
		if (isset($_POST['user_name'])) {
			$user_name=$_POST['user_name'];
		}
		if (isset($_POST['email'])) {
			$email=$_POST['email'];
		}
		if (isset($_POST['password'])) {
			$password=$_POST['password'];
			$password_encriptada=password_hash($password, PASSWORD_DEFAULT);
		}
		$con=new mysqli("localhost","root","","projetorc");

		if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
		}

		else{
			$idUtilizador=$_GET['id_utilizador'];
			$sql="update utilizadores set nome=?, user_name=?,password=?, email=? where id=?";
			$stm=$con->prepare($sql);
			if($stm!=false){

				$stm->bind_param('ssssi',$nome,$user_name,$password_encriptada,$email,$idUtilizador);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Utilizador editado com sucesso");</script>';
				echo 'Aguarde um momento. A reencaminhar página';
				header("refresh:2;url=index.php");
			}
			else{
			}
		}
	}
	else{
		echo "<h1>Houve um erro ao processar o seu pedido<br>Irá ser reencaminhada</h1>";
		header("refresh:2;url=index.php");
	}


	}
	else{
		echo "Para entrar nesta página necessita de efetuar <a href='../login.php'>login</a>";
		header("refresh:2;url=../login.php");
	}
?>

<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.js"></script>
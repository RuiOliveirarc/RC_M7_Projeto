<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
session_start();
if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {

	if($_SERVER['REQUEST_METHOD']=='GET'){


		$idLocal=$_GET['id_local'];
		$con=new mysqli("localhost","root", "","projetorc");

		if($con->connect_errno!=0){

			echo 'Ocorreu um erro no acesso à base de dados. <br>' .$con->connect_error;
			exit;
		}


		else{
			$sql='select * from locaislazer,cidades where locaislazer.id_cidade=cidades.id AND locaislazer.id=?';
			$stm=$con->prepare($sql);
			if($stm!=false){
				$stm->bind_param('i',$idLocal);
				$stm->execute();
				$res=$stm->get_result();
				$local=$res->fetch_assoc();
				$stm->close();
			}
			else{
				echo '<br>';
				echo ($con->error);
				echo '<br>';
				echo 'Aguarde um momento. A reencaminhar página';
				echo '<br>';
				header("refresh:2;url=index.php");
			}
		}
	}
?>


	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Detalhes</title>
	</head>
	<body>
		<h1>Detalhes do local</h1>
		<?php

			if (isset($local)) {
				echo '<br>';
				echo "Local: ";
				echo utf8_encode($local['local']);
				echo '<br>';
				echo "Cidade: ";
				echo utf8_encode($local['cidade']);
				echo '<br>';
				echo "Numero de ordem: ";
				echo utf8_encode($local['numordem']);
				echo '<br>';
			}
			else{
				echo "<h2>Parece que o local selecionado não existe. <br> Confirme a sua seleção. </h2>";
			}
		?>
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
	else{
		echo "Para entrar nesta página necessita de efetuar <a href='../login.php'>login</a>";
		header("refresh:2;url=../login.php");
	}
?>
<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
session_start();
if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {


	if($_SERVER['REQUEST_METHOD']=='POST'){
		$cidade='';
		

		if(isset($_POST['cidade'])){

			$cidade=$_POST['cidade'];
		}
		else{
			echo '<script>alert("É obrigatorio o preenchimento do cidade.");</script>';
		}
		$con=new mysqli("localhost","root","","projetorc");

		if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
		}

		else{
			$idCidade=$_GET['id_cidade'];
			$sql="update cidades set cidade=? where id=?";
			$stm=$con->prepare($sql);
			if($stm!=false){

				$stm->bind_param('is',$idCidade,$cidade);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Cidade editada com sucesso");</script>';
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
<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
	session_start();
	$con=new mysqli("localhost","root","","projetorc");
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$id_cidade='';
		$local='';
		$numordem='';
		if(isset($_POST['id_cidade'])){

			$id_cidade=$_POST['id_cidade'];
		}
		else{
			echo '<script>alert("É obrigatorio o preenchimento do cidade.");</script>';
		}
		if(isset($_POST['local'])){

			$local=$_POST['local'];
		}
		else{
			echo '<script>alert("É obrigatorio o preenchimento do local.");</script>';
		}
		if(isset($_POST['numordem'])){

			$numordem=$_POST['numordem'];
		}
		
		

		if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
		}

		else{
			$sql="insert into locaislazer (id_cidade,local,numordem)values(?,?,?)";
			$stm=$con->prepare($sql);

			if($stm!=false){

				$stm->bind_param('isi',$id_cidade,$local,$numordem);
				$stm->execute();
				$stm->close();

				echo '<script>alert("Local adicionado com sucesso");</script>';
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
		$sqlcidade="select * from cidades";
			$stmcidade=$con->prepare($sqlcidade);
			if($stmcidade!=false){
				$stmcidade->execute();
				$cidades=$stmcidade->get_result();
				$stmcidade->close();
			}
			else{
				echo ($con->error);
				echo 'Erro Aguarde um momento. A reencaminhar página';
				header("refresh:2;url=index.php");
			}
?>	
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Adicionar Local</title>
	</head>
	<body>
		<h1>Adicionar Local</h1>	
		<form action="local_create.php" method="post">

			<label>cidade</label>
			<select name="id_cidade" >
				<?php
				while ($resultado=$cidades->fetch_assoc())
					{

						echo '<option value="'.$resultado['id'].'">'. $resultado['cidade'].'</option>';
					}
				?>
			</select>

			<br>

			<label>Local</label>
			<input type="text" name="local" required>

			<br>

			<label>Numero de ordem</label>
			<input type="text" name="numordem">

			<br>

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

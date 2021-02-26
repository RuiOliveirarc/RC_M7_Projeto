<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php
	session_start();
	$con=new mysqli("localhost","root","","projetorc");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados" .$con->connect_error;
		exit;
	}
	else{
		if (!isset($_SESSION['login'])) {
			$_SESSION['login']="incorreto";
		}
		if ($_SESSION['login']=="correto") {
?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="ISO-8859-1">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
				<link rel="stylesheet" href="css/bootstrap.min.css">
				<title>Cidades</title>	
			</head>
			<body>
				<h1>Lista de cidades</h1>

				<?php
					$stm=$con->prepare('select * from cidades');
					$stm->execute();
					$res=$stm->get_result();
					while($resultado=$res->fetch_assoc()){

						echo $resultado['cidade'];
					
					

						echo '<a href="cidade_show.php?id_cidade=' .$resultado['id'].'">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
  									<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  									<path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
								</svg>
							</a>';


						echo '<a href="cidade_edit.php?id_cidade='.$resultado['id'].'">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  									<path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
								</svg>
							</a> ';


						echo '<a href="cidade_delete.php?id_cidade=' .$resultado['id'].'">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  									<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
								</svg>
							</a>';

						echo "<br>";
					}
					$stm->close();
				?>
				<br>
				<a href="cidade_create.php">
					<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  						<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  						<path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
					</svg>
				</a>
				<br>
				<a href="/">
					<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
  						<path fill-rule="evenodd" d="M6.603 2h7.08a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-7.08a1 1 0 0 1-.76-.35L1 8l4.844-5.65A1 1 0 0 1 6.603 2zm7.08-1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zM5.829 5.146a.5.5 0 0 0 0 .708L7.976 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
					</svg>
				</a>
				<script src="js/jquery-3.5.1.min.js"></script>
				<script src="js/bootstrap.js"></script>
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
		}
		?>
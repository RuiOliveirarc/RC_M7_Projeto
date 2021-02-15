<?php
	session_start();
	if($_SERVER['REQUEST_METHOD']=="POST"){
		if(isset($_POST['user_name']) && isset($_POST['password'])){

			$utilizador=$_POST['user_name'];
			$password=$_POST['password'];

			$con=new mysqli("localhost","root","","projetorc");

			if($con->connect_errno!=0){
				echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
				exit;
			}
			else{
				$sql="Select * from utilizadores where user_name=? AND password=?";
				$stm=$con->prepare($sql);
				if ($stm!=false) {
					$stm->bind_param("ss",$utilizador,$password);
					$stm->execute();
					$res=$stm->get_result();

					
					$util=$res->fetch_assoc();
					$stm->close();
					/*PASSWORD ENCRIPTADA
					$password_encriptada=$util['password'];
					$verify = password_verify($password, $password_encriptada);
					var_dump($verify);
					exit;*/
					$password_encriptada=$password;
					$_SESSION['id_user']=$util['id'];

					/*if ($verify==True) {
						$_SESSION['login']="correto";
					}
					else{
						$_SESSION['login']="incorreto";
					}*/
					$_SESSION['login']="correto";
					
					header("refresh:2;url=index.php");
				}
				else{
					echo "Ocorreu um erro no acesso á base de dados. <br> STM:".$con->connect_error;
					exit;
				}
			}
		}
	}
?>

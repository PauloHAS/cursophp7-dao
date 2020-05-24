<!DOCTYPE html>
<html>
<head>
	<title>Estudo de PDO</title>
</head>
<body>

	<?php 

	$conn = new PDO("mysql:dbname=db_testes;host:localhost","root","");


//Listaando dados do banco com PDO

			$stmt = $conn->prepare("SELECT * FROM usuario ORDER BY nome ASC");
			$stmt->execute();

			$results = $stmt->fetchall(PDO::FETCH_ASSOC);

			foreach ($results as $rows) {
				foreach ($rows as $key => $value) {
					echo "<strong>".$key.":</strong>".$value."</br>";
				}

				echo "======================================================</br>";
			}

	//var_dump($results);

//Inserindo dados no banco com PDO
			/*

		$stmt = $conn->prepare("INSERT INTO usuario (nome, senha) VALUES (:NOME, :SENHA)");
		$nome = "Viviane Souza";
		$senha = "31011983";

		$stmt->bindParam(":NOME", $nome);
		$stmt->bindParam(":SENHA", $senha);

		$stmt ->execute();

		echo "Dados inseridos com sucesso!";
		*/

		//Alterando dados no banco com PDO
/*
		$stmt = $conn->prepare("UPDATE usuario SET nome = :NOME, senha = :SENHA WHERE idusuario = :ID");

		$nome = "Viviane Braga";
		$senha = "paulo";
		$idusuario = 2;

		$stmt->bindParam(":NOME",$nome);
		$stmt->bindParam(":SENHA",$senha);
		$stmt->bindParam(":ID",$idusuario);

		$stmt->execute();

		echo "Dados Alterados com Sucesso!";
*/
		//removendo dados do banco com PDO
/*
		$stmt =$conn->prepare("DELETE FROM usuario WHERE idusuario = :ID");
		
		$id = 2;

		$stmt->bindParam(":ID", $id);

		$stmt->execute();

		echo "Deletado com Sucesso!"
*/
//Delete com transação
/*
		$conn->beginTransaction();

		$stmt =$conn->prepare("DELETE FROM usuario WHERE idusuario = ?");
		
		$id = 3;

		$stmt->execute(array($id));

		//$conn->rollback();
		$conn->commit();
		echo "Deletado com Sucesso!"
*/
			?>

		</body>
		</html>


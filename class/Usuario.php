<?php 

class Usuario{

	private $idusuario;
	private $nome;
	private $senha;
	private $dtcadastro;

	public function getIdusario() {
		return $this->idusario;
	}

	public function setIdusario($idusario) {
		$this->idusario = $idusario;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	public function setDtcadastro($dtcadastro) {
		$this->dtcadastro = $dtcadastro;
	}

	public function loadById($id){
		$sql = new Sql();

		$results = $sql-> select("SELECT * FROM usuario WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if (count($results)>0) {
			$row = $results[0];

			$this->setIdusario($row['idusuario']);
			$this->setNome($row['nome']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}
//listar todos usuarios ordenados pelo campo nome
	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM usuario ORDER BY nome");
	}

	//buscar usuario por um nome expecifico

	public static function search($nome){
		$sql = new Sql();

		return $sql->select("SELECT * FROM usuario WHERE nome LIKE :SEARCH ", array(
			':SEARCH'=>"%".$nome."%"

		));
	}

	//buscar usuarios autenticados no banco
	public function login($nome, $senha){

		$sql = new Sql();

		$results = $sql-> select("SELECT * FROM usuario WHERE nome = :NOME AND senha = :SENHA", array(
			":NOME"=>$nome,
			":SENHA"=>$senha
		));

		if (count($results)>0) {
			$row = $results[0];

			$this->setIdusario($row['idusuario']);
			$this->setNome($row['nome']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}else{
			throw new Exception("Login ou senha inválidos");
			
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusario(),
			"nome"=>$this->getNome(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}


?>
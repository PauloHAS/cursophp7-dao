<?php 

class Usuario{

	private $idusuario;
	private $nome;
	private $senha;
	private $dtcadastro;

	public function getIdusario() {
		return $this->idusuario;
	}

	public function setIdusuario($idusuario) {
		$this->idusuario = $idusuario;
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

			$this->setData($results[0]);

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

			$this->setData($results[0]);

		}else{
			throw new Exception("Login ou senha inválidos");
			
		}
	}

	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setNome($data['nome']);
		$this->setSenha($data['senha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}

//função para inserir informações no banco de dados

	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuario_insert(:LOGIN, :SENHA)", array(
			":LOGIN"=>$this->getNome(),
			":SENHA"=>$this->getSenha()

		));

		if (count($results[0]) > 0) {
			$this->setData($results[0]);

		}
	}
//função para atualizar informações do banco de dados
	public function update($nome, $senha){
		$this->setNome($nome);
		$this->setSenha($senha);
		$sql = new Sql();

		$sql->query("UPDATE usuario SET nome = :NOME, senha = :SENHA WHERE idusuario = :ID", array(
			':NOME' =>$this->getNome(),
			':SENHA' =>$this->getSenha(),
			':ID' => $this->getIdusario()
		));
	}

	public function delete(){
		$sql = new Sql();

		$sql->query("DELETE FROM usuario WHERE idusuario = :ID",array(
			":ID"=>$this->getIdusario()
		));

		$this->setIdusuario(0);
		$this->setNome("");
		$this->setSenha("");
		$this->setDtcadastro(new DateTime());

	}

	public function __construct($login = "", $senha = ""){
		$this->setNome($login);
		$this->setSenha($senha);

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
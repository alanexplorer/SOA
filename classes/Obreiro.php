<?php

require_once('Database.class.php');

class Obreiro
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uCongregacao, $uNome, $uNascimento, $uRG, $uCPF, $uPai, $uMae, $uNacionalidade, $uNaturalidade, $uEstado, $uTelefone, $uProfissao, $uEndereco, $uNumero, $uBairro, $uCidade, $uCep, $uEstado_Civil, $uNome_do_Conjuge, $uCPF_do_Conjuge,	$uNumero_de_Filhos, $uFuncao_Ministerial, $uDesde, $uIgreja)
	{
		try
		{	
			$stmt = $this->conn->prepare("INSERT INTO obreiro(Congregacao, Nome, Nascimento, RG, CPF, Pai, Mae, Nacionalidade, Naturalidade, Estado, Telefone, Profissao, Endereco, Numero, Bairro, Cidade, Cep, Estado_Civil, Nome_do_Conjuge, CPF_do_Conjuge, Numero_de_Filhos, Funcao_Ministerial, Desde, Igreja) VALUES(:uCongregacao, :uNome, :uNascimento, :uRG, :uCPF, :uPai, :uMae, :uNacionalidade, :uNaturalidade, :uEstado, :uTelefone, :uProfissao, :uEndereco, :uNumero, :uBairro, :uCidade, :uCep, :uEstado_Civil, :uNome_do_Conjuge, :uCPF_do_Conjuge, :uNumero_de_Filhos, :uFuncao_Ministerial, :uDesde, :uIgreja)");
			
			$stmt->bindparam(":uCongregacao", $uCongregacao);
			$stmt->bindparam(":uNome", $uNome);
			$stmt->bindparam(":uNascimento", $uNascimento);
			$stmt->bindparam(":uRG", $uRG);
			$stmt->bindparam(":uCPF", $uCPF);
			$stmt->bindparam(":uPai", $uPai);
			$stmt->bindparam(":uMae", $uMae);
			$stmt->bindparam(":uNacionalidade", $uNacionalidade);
			$stmt->bindparam(":uNaturalidade", $uNaturalidade);
			$stmt->bindparam(":uEstado", $uEstado);
			$stmt->bindparam(":uTelefone", $uTelefone);
			$stmt->bindparam(":uProfissao", $uProfissao);
			$stmt->bindparam(":uEndereco", $uEndereco);
			$stmt->bindparam(":uNumero", $uNumero);
			$stmt->bindparam(":uBairro", $uBairro);
			$stmt->bindparam(":uCidade", $uCidade);
			$stmt->bindparam(":uCep", $uCep);
			$stmt->bindparam(":uEstado_Civil", $uEstado_Civil);
			$stmt->bindparam(":uNome_do_Conjuge", $uNome_do_Conjuge);
			$stmt->bindparam(":uCPF_do_Conjuge", $uCPF_do_Conjuge);
			$stmt->bindparam(":uNumero_de_Filhos", $uNumero_de_Filhos);
			$stmt->bindparam(":uFuncao_Ministerial", $uFuncao_Ministerial);
			$stmt->bindparam(":uDesde", $uDesde);
			$stmt->bindparam(":uIgreja", $uIgreja);
												  
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
}
?>
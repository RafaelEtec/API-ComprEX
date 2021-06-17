<?php 
	
	class DbOperation
	{

		private $con;

		function __construct()
		{

			require_once dirname(__FILE__). 'DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();
		}

		function getProdutos() {
			$stmt = $this->con->prepare("SELECT id, nome, descricao, quantidade, valorUni, dataEntrada, imagem FROM tbprodutos");
			$stmt->execute();
			$stmt->bind_result($id, $nome, $descricao, $quantidade, $valorUni, $dataEntrada, $imagem);

			$produtos = array();

			while ($stmt->fetch()) {

				$produto = array();
				$produto['id'] = $id;
				$produto['nome'] = $nome;
				$produto['descricao'] = $descricao;
				$produto['quantidade'] = $quantidade;
				$produto['valorUni'] = $valorUni;
				$produto['dataEntrada'] = $dataEntrada;
				$produto['imagem'] = $imagem;

				array_push($produtos, $produto);
			}
			return $produtos;
		}

		function createProduto($nome, $descricao, $quantidade, $valorUni, $imagem) {
			$stmt = $this->prepare("INSERT INTO tbprodutos (nome, descricao, quantidade, valorUni, imagem) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("ssidb",$nome, $descricao, $quantidade, $valorUni, $imagem);
			if ($stmt->execute())
				return true;
			return false;
		}

		function updateProduto($id, $nome, $descricao, $quantidade, $valorUni) {
			$stmt = $this->con->prepare("UPDATE tbprodutos SET nome = ?, descricao = ?, quantidade = ?, valorUni = ? WHERE id = ?");
			$stmt->bind_param("ssidi", $nome, $descricao, $quantidade, $valorUni, $id);
			if($stmt->execute())
				return true;
			return false;
		}

		function deleteProduto($id) {
			$stmt = $this->con->prepare("DELETE FROM tbprodutos WHERE id = ?");
			$stmt->bind_param("i", $id);
			if ($stmt->execute())
				return true;
			return false;
		}
	}
?>
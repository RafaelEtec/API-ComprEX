<?php 
	
	require_once '../includes/DbOperation.php';

	function isTheseParametersAvailable($params){
		$available = true;
		$missingparams = "";

		foreach ($params as $param) {
			if (!isset($_POST[$param]) || strlen($_POST[$param]) <=0) {

				$available = false;
				$missingparams = $missingparams . ", " . $param;
			}
		}

		if (!$available) {

			$response = array();
			$response['error']  = true;
			$response['message'] = 'Parameters ' . substr($missin, 1, strle($missingparams)) . ' missing';

			echo json_encode($response);

			die();
		}
	}

	$response = array();

	if (isset($_GET['apicall'])) {

		switch ($_GET['apicall']) {

			case 'getProdutos':

				$db = new DbOperation();
				$response['error'] = false;
				$response['message'] = 'Pedido concluído';
				$response['produtos'] = $db->getProdutos();
			break;

			case 'createProduto':

				isTheseParametersAvailable(array('nome', 'descricao', 'quantidade', 'valorUni', 'imagem'))
				$db = new DbOperation();
				$result = $db->createProduto(
					$_POST['nome'],
					$_POST['descricao'],
					$_POST['quantidade'],
					$_POST['valorUni'],
					$_POST['imagem']
				);

				if ($result) {

					$response['error'] = false;
					$response['message'] = 'Produto adicionado';
					$response['produtos'] = $db->getProdutos();
				}else {

					$response['error'] = true;
					$response['message'] = 'Ocorreu um erro, tente novamente';
				}
			break;

			case 'updateProduto':

				isTheseParametersAvailable(array('id', 'nome', 'descricao', 'quantidade', 'valorUni'));
				$db = new DbOperation();
				$result = $db->updateProduto(
					$_POST['id'],
					$_POST['nome'],
					$_POST['descricao'],
					$_POST['quantidade'],
					$_POST['valorUni']
				);

				if ($result) {
					
					$response['error'] = false;
					$response['message'] = 'Produto atualizado';
					$response['produtos'] = $db->getProdutos();
				} else {

					$response['error'] = true;
					$response['message'] = 'Ocorreu um erro, tente novamente';
				}
			break;
			
			case 'deleteProduto':

				if (isset($_GET['id'])) {
					
					$db = new DbOperation();
					if ($db->deleteProduto($_GET['id'])) {
						
						$response['error'] = false;
						$response['message'] = 'Produto excluído';
						$response['produtos'] = $db->getProdutos();
					} else {

						$response['error'] = true;
						$response['message'] = 'Ocorreu um erro, tente novamente';
					}
				} else {

					$response['error'] = true;
					$response['message'] = 'Não foi possível deletar, forneça o ID'
				}
			break;
		}
	} else {

		$response['error'] = true;
		$response['message'] = 'Chamada de API Inválida';
	}

	echo json_encode($response);
 ?>
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
			
			default:
				# code...
				break;
		}
	}







 ?>
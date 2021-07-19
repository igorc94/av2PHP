<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
		$categoria = $_GET["categoria"];
		$formEr = 0;
		
		function validatorA($formDado) {
			if ($formDado == "" or ctype_alpha($formDado)) {
				$formEr = 1;
			}
		}
		
		validatorA($categoria);
		
		if ($formInvalido == 0) {
			
			//fazendo conexao com o banco
			$servidor = "localhost";
			$usuario = "root";
			$senha = "";
			$nomebanco= "3dawfaeterj";

			$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
			if (!$conn) 
			{
				echo "Erro de conexao no DB. Tente novamente";
			}
			
			$sql2nd=" SELECT ID FROM categoria WHERE NOME = '$categoria' ";
			$resultado = $conn->query($sql2nd);
			$res = $resultado->fetch_assoc();
		
			$id = $res['ID'];
			
			
			$sql="SELECT * FROM tipo WHERE ID_CATEGORIA = $id";
			
			$result = $conn->query($sql);
			$categoArray = array();
			
			$i=0;
			
			if($result = $conn->query($sql))
			{
				while($db_field = $result->fetch_assoc())
				{
					$categoArray[$i]= utf8_decode($db_field["NOME"]);
					$i++;
				}
			}
			header('Content-Type: application/json; charset=utf-8 ');
			echo json_encode($categoArray);
		}
}

?>
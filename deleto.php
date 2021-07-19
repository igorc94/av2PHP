<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$cod = $_GET["codigo"];
		$ativo = false;
		$ready = 0;
		
		if($cod != "" and ctype_digit($cod))
		{
			$ready=1;
		}

		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$nomebanco= "3dawfaeterj";
			
		$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
		if (!$conn) 
		{
			echo "Erro ao conectar no DB";
		}
			
		if($ready == 1)
		{
			echo "RESULTADO<br>";
			
			$sql = "UPDATE produto SET ATIVO = false WHERE COD_BARRA = '$cod'";
			
			if($resultado = $conn->query($sql) == TRUE )
			{
				echo "Produto excluido.";
			}
		}
		else 
		{
			echo "Erro na exclusao.;
		}
	
	}
?>


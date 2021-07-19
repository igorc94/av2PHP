<?php
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	
		
		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$nomebanco= "3dawfaeterj";

		$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
		if (!$conn) 
		{
			echo "Erro ao conectar ao DB. Tente novamente.";
		}
		
		//SQL
		$sql="SELECT * FROM categoria";
		
		$result = $conn->query($sql);
		$cateArray = array();
		
		$i=0;
		
		while($db_field = $result->fetch_assoc())
		{
			$arrCat[$i]= utf8_decode($db_field["NOME"]);
			$i++;
		}
		header('Content-Type: application/json; charset=utf-8 ');
		echo json_encode($cateArray);
	
}

?>
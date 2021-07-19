<?php
$msgErro = "";
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
	
	$cod = $_GET["codigo"];

	
		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$nomebanco= "3dawfaeterj";
		
		if($cod!="" and ctype_digit($cod))//validando
		{
			
			$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
			if (!$conn) 
			{
				echo "Erro ao conectar DB. Tente de novo.";
			}
			
			$sql = "SELECT * FROM produto WHERE COD_BARRA = $cod ";
			$resultado = $conn->query($sql);
			$res = $resultado->fetch_assoc();
			
			
			$value["nome"] = $res["NOME"];
			$value["id"] = $res["ID_PROD"];
			$value["descricao"] = $res["DESCRICAO"];
			$value["preco"] = $res["PRECO"];
			$value["peso"] = $res["PESO"];
			$value["tipo"] = $res["TIPO"];
			$value["categoria"] = $res["CATEGORIA"];
			$value["fabricante"] = $res["FABRICANTE"];
			$value["quant"] = $res["QUANT_EST"];
			$value["cod"] = $res["COD_BARRA"];
			$value["data"] = $res["DATA_CADASTRO"];
			$value["ativo"]  = $res["ATIVO"];
			$value["img"]= "Imagens/".$res["IMG"];
			
			
			header('Content-Type: application/json; charset=utf-8 ');
			echo json_encode($value);
		}
		else
		{
			echo "Erro no Codigo de Barras.";
		}
}

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
		$cod = $_GET["codigo"];
		
		$servidor = "localhost";
		$usuario = "root";
		$senha = "";
		$nomebanco= "3dawfaeterj";

		$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
		if (!$conn) 
		{
			echo "Erro na conexao com DB. Tente novamente.";
		}
		
		//SQL
		$sql="SELECT * FROM produto WHERE COD_BARRA='$cod' AND ATIVO =true";
		$result = $conn->query($sql);
		$colunas = mysqli_num_rows($result);
		
			if ($colunas > 0) 
			{
				$arr = array();
				$i=1;
				
				while ($res = $result->fetch_assoc()) 
				{
					echo "<fieldset style='width:40%'>";
					echo "<img src='Img/".$res["IMG"]."' style='width:30%'/><br />";
					echo "<p>Nome do Produto: ".$res['NOME']."</p>";
					echo "<p>Categoria: ".$res['CATEGORIA']."</p>";
					echo "<p>Tipo: ".$res['TIPO']."</p>";
					echo "<p>Fabricante: ".$res['FABRICANTE']."</p>";	
					echo "<p>Cod_Barra: ".$res['COD_BARRA']."</p>";
					echo "<p>Peso: ".$res['PESO']."</p>";
					echo "<p>Quant_Est: ".$res['QUANT_EST']."</p>";
					echo "<p>Data_Cadastro: ".$res['DATA_CADASTRO']."</p>";
					echo "<p>Preco: ".$res['PRECO']."</p>";
					echo "<p> Descricao: ".$res['DESCRICAO']."</p><br>";
					echo "</fieldset>";
				}
				echo "</table>";
				$result->close();
			}
			else {
				echo "Impossivel apagar, arquivo inexistente.";
			}
}

?>
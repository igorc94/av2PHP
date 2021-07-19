<?php 
	
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			$cod = $_GET["codigo"];
			
			$servidor = "localhost";
			$usuario = "root";
			$senha = "";
			$nomebanco= "3dawfaeterj";
			
			$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
			if (!$conn) 
			{
				echo "Erro de conexao ao DB. Tente novamente";
			}
			
			$sql = "SELECT * FROM produto WHERE COD_BARRA = $cod AND ATIVO = TRUE";
			
			if ($result = $conn->query($sql)) 
			{
				$arr = array();
				$i=1;
				
				while ($res = $result->fetch_assoc()) 
				{
					echo "<h1>".$res['NOME']."</h1>";
					echo "<p>Categoria: ".$res['CATEGORIA']."</p>";
					echo "<p>Tipo: ".$res['TIPO']."</p>";
					echo "<p>Fabricante: ".$res['FABRICANTE']."</p>";	
					echo "<p>Cod_Barra: ".$res['COD_BARRA']."</p>";
					echo "<p>Peso: ".$res['PESO']."</p>";
					echo "<p>Quant_Est: ".$res['QUANT_EST']."</p>";
					echo "<p>Data de Registro: ".$res['DATA_CADASTRO']."</p>";
					echo "<p>Preco: ".$res['PRECO']."</p>";
					echo "<p>Descricao: ".$res['DESCRICAO']."</p><br>";
		
				}
				
				echo "</table>";
				$result->close();
			}
			else
			{
				echo "Produto nao achado com esse codigo de barra";
			}
?>
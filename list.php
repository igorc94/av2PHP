<?php
	
			$servidor = "localhost";
			$usuario = "root";
			$senha = "";
			$nomebanco= "3dawfaeterj";
			
			$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
			if (!$conn) 
			{
				echo "Erro ao conectar ao DB. Tente novamente";
			}
			$sql = "SELECT * FROM produto WHERE ATIVO = TRUE";
				
			if ($result = $conn->query($sql)) 
			{
				$arr = array();
				$i=1;
								
				while ($res = $result->fetch_assoc()) 
				{
					echo "<tr>";
					echo "<td style='text-align: center'><a href=\"details.html?codigo=$res[COD_BARRA]\">".$res['NOME']."</a></td>";
					echo "<td style='text-align: center'>".$res['CATEGORIA']."</td>";
					echo "<td style='text-align: center'>".$res['COD_BARRA']."</td>";
					echo "<td style='text-align: center'>".$res['PRECO']."</td>";
					echo "<td style='text-align: center'>".$res['QUANT_EST']."</td>";
					echo "<td style='text-align: center'><a href=\"update.html?cod=$res[COD_BARRA]\">Editar</a>  |  <a href=\"deleto.html\">Apagar</a></td>";		
					echo "<br>";
					echo "</tr>";
				}
				echo "</table>";
				$result->close();
			}
?>
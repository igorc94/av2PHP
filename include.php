<?php
$msgErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	
    $nome = $_POST["nome"];
    $id = $_POST["id"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $peso = $_POST["peso"];
    $tipo = $_POST["tipo"];
	$categoria = $_POST["categoria"];
	$fabricante = $_POST["fabricante"];
	$quant = $_POST["quant"];
	$cod = $_POST["codigo"];
	$data = $_POST["data"];
	$ativo= true;
	
	$img = $_FILES["files"];
	print_r ( $img );
	
	$formInvalido = 0;
	
	
	function validaIMG($img,$cod){
		if ( $img == "none" )
		{
			$formInvalido = 1;
		}
		else{
			$error = 0 ;
			// Verifica se o arquivo é uma imagem
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $img["type"])){
			   $formInvalido = 1;
			   $error = 1;
			} 
			// Pega as dimensões da imagem
			$dimensoes = getimagesize($img["tmp_name"]);

			// Se não houver nenhum erro
			if ($error == 0) {
			
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $img["name"], $ext);

				// Gera um nome único para a imagem
				$nome_imagem = $cod . "." . $ext[1];
				
				// Caminho de onde ficará a imagem, mas tem que criar uma pasta antes
				//$dir =  "C:/Imagens/";
				//$dir = "C:/xampp1/htdocs/3daw/Imagens/";
				
				//if(!file_exists($dir))
				//{
					//mkdir($dir,0777,true);
				//}
				
				//$caminho_imagem = "C:/Imagens/" . $nome_imagem;
				$caminho_imagem = "C:/xampp1/htdocs/3daw/Imagens/" . $nome_imagem;

				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($img["tmp_name"], $caminho_imagem);
				
				echo "imagemNEW: $nome_imagem";
				return $nome_imagem;
				
			}
		}
	}
    function validaDadosAlpha($formDado) {
        if ($formDado == "" or ctype_alpha($formDado)) {
            $formInvalido = 1;
        }
    }
	function validaData($formDado) {
        $date= DateTime::createFromFormat('y-m-d',$formDado);
		if ($date && $date->format('y-m-d') != $formDado) {
            $formInvalido = 1;
        }
    }
    function validaDadosDigit($formDado) {
        if ($formDado == "" or !ctype_digit($formDado)) {
            $formInvalido = 1;
        }
    }
    
	
	$nome_imagem = validaIMG($img,$cod);
	validaData($data);
    validaDadosAlpha($nome);
    validaDadosDigit($id);
    validaDadosAlpha($fabricante);
	validaDadosAlpha($categoria);
	validaDadosAlpha($tipo);
    validaDadosDigit($quant);
    validaDadosAlpha($descricao);
    validaDadosDigit($cod);
	validaDadosDigit($preco);
	validaDadosDigit($peso);
	
	echo "imagemNEW2: $nome_imagem";

    $msgErro = "";
	
    if ($formInvalido == 0) {
		
        //fazendo conexao com o banco
			$servidor = "localhost";
			$usuario = "root";
			$senha = "";
			$nomebanco= "3daw_AV2";
			
			
			$conn = new mysqli($servidor,$usuario,$senha,$nomebanco);
			if (!$conn) 
			{
				echo "ERRO AO CONECTAR BANCO DE DADOS!!";
			}
			
			//so inseri se codigo de barra nao existi no BD
			$pesq = "SELECT NOME FROM protudo WHERE COD_BARRA = '$cod' ";
			$r = $conn->query($pesq);
			$contagem = mysqli_num_rows($r);
			
			if($contagem > 0)
			{
				//imprimindo do banco
				$sql = "INSERT INTO produto (ID_PROD,NOME,CATEGORIA,TIPO,FABRICANTE,COD_BARRA,IMG,DESCRICAO,PRECO,PESO,QUANT_EST,ativo,DATA_CADASTRO) 
				VALUES ($id,'$nome','$categoria','$tipo','$fabricante','$cod','$nome_imagem','$descricao',$preco,$peso,$quant,$ativo,'$data')";
			
				if($resultado = $conn->query($sql))
				{
					echo "Produto $nome inserido com sucesso!!<br>";
					echo "<br><br>";
					echo "<br/><a href='#'>Ver Resultado</a>";
				}
				else 
				{
				  echo "Erro no inserir ";
				}
			}
			
		}
		else
		{
			echo "ERRO EM UM DOS CAMPOS DO FORMULARIO, VOLTE E CORRIJA";
		}
}
?>